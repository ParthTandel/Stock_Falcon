import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.URL;
import java.util.*;
import java.text.DecimalFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import org.encog.ml.data.MLData;
import org.encog.ml.data.MLDataPair;
import org.encog.ml.data.market.MarketDataDescription;
import org.encog.ml.data.market.MarketDataType;
import org.encog.ml.data.market.MarketMLDataSet;
import org.encog.ml.data.market.loader.MarketLoader;
import org.encog.ml.data.temporal.TemporalDataDescription.Type;
import org.encog.ml.data.market.loader.YahooFinanceLoader;
import org.encog.ml.data.market.TickerSymbol;
import org.encog.neural.networks.BasicNetwork;
import org.encog.persist.EncogDirectoryPersistence;
import org.encog.ml.data.temporal.TemporalPoint;
import org.encog.ml.data.market.loader.LoadedMarketData;
import org.encog.util.csv.CSVFormat;
import org.encog.util.csv.ReadCSV;
import org.encog.util.http.FormUtility;

import java.sql.*;

public class MarketEvaluate
{
	enum Direction 
	{
		up, down
	}

	
	
	public static Direction determineDirection(double d) 
	{
		if (d < 0)
			return Direction.down;
		else
			return Direction.up;
	}
	
	public static URL buildURL(final TickerSymbol ticker, final Date from,final Date to) throws IOException 
	{
		// process the dates
		final Calendar calendarFrom = Calendar.getInstance();
		calendarFrom.setTime(from);
		final Calendar calendarTo = Calendar.getInstance();
		calendarTo.setTime(to);

		// construct the URL
		final OutputStream os = new ByteArrayOutputStream();
		final FormUtility form = new FormUtility(os, null);
		form.add("s", ticker.getSymbol().toUpperCase());
		form.add("a", "" + calendarFrom.get(Calendar.MONTH));
		form.add("b", "" + calendarFrom.get(Calendar.DAY_OF_MONTH));
		form.add("c", "" + calendarFrom.get(Calendar.YEAR));
		form.add("d", "" + calendarTo.get(Calendar.MONTH));
		form.add("e", "" + calendarTo.get(Calendar.DAY_OF_MONTH));
		form.add("f", "" + calendarTo.get(Calendar.YEAR));
		form.add("g", "d");
		form.add("ignore", ".csv");
		os.close();
		final String str = "http://ichart.finance.yahoo.com/table.csv?"
				+ os.toString();
				System.out.println("url-"+str);
		return new URL(str);
	}

	
	@SuppressWarnings("deprecation")
	public static Collection<LoadedMarketData> _load(final TickerSymbol ticker,final Set<MarketDataType> dataNeeded, final Date from,final Date to) throws IOException
	{
		
			final Collection<LoadedMarketData> result =	new ArrayList<LoadedMarketData>();
			final URL url = buildURL(ticker, from, to);
			final InputStream is = url.openStream();
			final ReadCSV csv = new ReadCSV(is, true, CSVFormat.ENGLISH);

			
			if(to.getDay()!=0 || to.getDay()!=6)
			{
				Date d=to;
				LoadedMarketData data1 = new LoadedMarketData(d, ticker);
				data1.setData(MarketDataType.ADJUSTED_CLOSE, 0);
				data1.setData(MarketDataType.OPEN,0);
				data1.setData(MarketDataType.CLOSE,0);
				data1.setData(MarketDataType.HIGH, 0);
				data1.setData(MarketDataType.LOW, 0);
				data1.setData(MarketDataType.OPEN, 0);
				data1.setData(MarketDataType.VOLUME,0);
				result.add(data1);
				
			}
			
			
			
			
			while (csv.next()) 
			{
				final Date date = csv.getDate("date");
				final double adjClose = csv.getDouble("adj close");
				final double open = csv.getDouble("open");
				final double close = csv.getDouble("close");
				final double high = csv.getDouble("high");
				final double low = csv.getDouble("low");
				final double volume = csv.getDouble("volume");

				final LoadedMarketData data = 
					new LoadedMarketData(date, ticker);
				data.setData(MarketDataType.ADJUSTED_CLOSE, adjClose);
				data.setData(MarketDataType.OPEN, open);
				data.setData(MarketDataType.CLOSE, close);
				data.setData(MarketDataType.HIGH, high);
				data.setData(MarketDataType.LOW, low);
				data.setData(MarketDataType.OPEN, open);
				data.setData(MarketDataType.VOLUME, volume);
				result.add(data);
			}
			

			csv.close();
			return result;
		
	}
	
	
	public static void loadPointFromMarketData(final TickerSymbol ticker,final TemporalPoint point, final LoadedMarketData item,MarketDataDescription desc) 
	{
			final MarketDataDescription mdesc = (MarketDataDescription) desc;

			if (mdesc.getTicker().equals(ticker))
			{
				point.setData(mdesc.getIndex(), item.getData(mdesc.getDataType()));
			}
	}

	
	
	public static void loadSymbol1(final TickerSymbol ticker, final Date from,final Date to,MarketMLDataSet r,MarketDataDescription desc) throws IOException  
	{
		final Collection<LoadedMarketData> data = _load(ticker,null, from, to);
		for (final LoadedMarketData item : data) 
		{
			final TemporalPoint point = r.createPoint(item.getWhen());

			loadPointFromMarketData(ticker, point, item,desc);
		}
	}	
	
	public static void load_data(final Date begin, final Date end,MarketMLDataSet r,MarketDataDescription desc) throws IOException
	{
		if (r.getStartingPoint() == null)
		{
			r.setStartingPoint(begin);
		}

				r.getPoints().clear();

		final Set<TickerSymbol> set = new HashSet<TickerSymbol>();
		
		final MarketDataDescription mdesc = (MarketDataDescription) desc;
			set.add(mdesc.getTicker());
		
		for (final TickerSymbol symbol : set) 
		{
			loadSymbol1(symbol, begin, end,r,desc);
		}

		r.sortPoints();
		
	}

	
	public static MarketMLDataSet grabData() throws IOException 
	{
		MarketLoader loader = new YahooFinanceLoader();
		MarketMLDataSet result = new MarketMLDataSet(loader,Config.INPUT_WINDOW, Config.PREDICT_WINDOW);
		MarketDataDescription desc = new MarketDataDescription(Config.TICKER,MarketDataType.ADJUSTED_CLOSE,true, true);
		result.addDescription(desc);
		Calendar end = new GregorianCalendar();// end today
		Calendar begin = (Calendar) end.clone();// begin 30 days ago
		begin.add(Calendar.DATE, -60);
		end.add(Calendar.DATE,0);
		System.out.println("date start-"+begin.getTime()+" till "+end.getTime());
		load_data(begin.getTime(), end.getTime(),result,desc);
		result.generate();
		return result;
	}
	
	public static MarketMLDataSet grabData_RAW() throws IOException 
	{
		MarketLoader loader = new YahooFinanceLoader();
		MarketMLDataSet result = new MarketMLDataSet(loader,Config.INPUT_WINDOW, Config.PREDICT_WINDOW);
		MarketDataDescription desc = new MarketDataDescription(Config.TICKER,MarketDataType.ADJUSTED_CLOSE,Type.RAW,true, true);
		result.addDescription(desc);
		Calendar end = new GregorianCalendar();// end today
		Calendar begin = (Calendar) end.clone();// begin 30 days ago
		begin.add(Calendar.DATE, -60);
		end.add(Calendar.DATE, 0);
		//System.out.println("date start-"+begin.getTime().getDate()+" till "+end.getTime().getDate());
		load_data(begin.getTime(), end.getTime(),result,desc);
		result.generate();
		return result;
	}
	
	//evaluate->predict and check
	
	public static void evaluate(File dataDir) throws IOException 
	{
		File file = new File(dataDir,Config.NETWORK_FILE);
		
		if (!file.exists()) 
		{
			System.out.println("Can't read file: " + file.getAbsolutePath());
			return;
		}
		
		//creating the basic neural network 
		
		BasicNetwork network = (BasicNetwork)EncogDirectoryPersistence.loadObject(file);
		MarketMLDataSet data = grabData();
		MarketMLDataSet raw_data = grabData_RAW();
		DecimalFormat format = new DecimalFormat("#0.0000");
		int count = 0;
		int correct = 0;
		double prev=0;
		
		double actual[]=new double[10000];
		double predict[]=new double[10000];
		double diff[]=new double[10000];
		Direction actualDirection[]=new Direction[10000];
		Direction predictDirection[]=new Direction[10000];
			
		//actual prediction starts; also the confidence value is being calculated
		for (MLDataPair pair : data) 
		{
			
			MLData input = pair.getInput();
		
			MLData actualData = pair.getIdeal();
			MLData predictData = network.compute(input);
			actual[count] = actualData.getData(0);
			predict[count] = predictData.getData(0);
		   
			actualDirection[count] = determineDirection(actual[count]);
			predictDirection[count] = determineDirection(predict[count]);
			if (actualDirection[count] == predictDirection[count])
				correct++;
			count++;
			
		}
		
		int cnt=0;
		MLData actualD = null;
		String predicted_value=null;
		
		for (MLDataPair pair : raw_data) 
		{
			 actualD = pair.getIdeal();
				System.out.println("Input-"+pair.getInput().getData(0));
			 diff[cnt] = (((predict[cnt]+1)*prev) - actualD.getData(0));
			System.out.println("Day " + cnt + ":actual="+ actualD.getData(0) + "(" + actualDirection[cnt] + ")"+ ",predict=" + format.format(((predict[cnt]+1)*prev)) + "("+ predictDirection[cnt] + ")" + ",diff=" + diff[cnt]);
			
			predicted_value=format.format(((predict[cnt]+1)*prev));
			prev=actualD.getData(0);
			cnt++;
		}
		System.out.println("predicted value- "+predicted_value);
		double percent = (double) correct / (double) count;
		System.out.println("Direction correct:" + correct + "/" + count);	
		System.out.println("Directional Accuracy:"+ format.format(percent * 100) + "%");
		String confidence_value=format.format(percent * 100);
		
		//writing the value to the database
		
		String url = "jdbc:mysql://localhost:3306/stockfalcon";
        String user = "root";
        String password = "";
        
        try
        {
            Class.forName("org.gjt.mm.mysql.Driver");
            Connection con = DriverManager.getConnection(url, user, password);
            Statement s=con.createStatement();
            
            String n=Config.TICKER.getSymbol();
			String delims = "[.]";
			String[] tokens = n.split(delims);
			
            String query="UPDATE `prediction` SET `predicted_value`= '"+predicted_value+"' ,`confidence_value`='"+confidence_value+"',`difference`= '"+diff[count-1]+"' WHERE prediction.stock_ticker='"+tokens[0]+"'	";
                    
            s.executeUpdate(query);
            System.out.println("sql-"+tokens[0]);
          
            con.close();
            
        }
        catch (Exception e)
        {
            e.printStackTrace();
        }
		
	}
}