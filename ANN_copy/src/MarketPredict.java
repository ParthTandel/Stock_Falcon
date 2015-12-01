import java.io.File;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.Statement;
import java.sql.*;

import org.encog.Encog;
/**
* Use the saved market neural network, and now attempt to predict for today, and the
* last 60 days and see what the results are.
*/
public class MarketPredict
{
	public static void main(String[] args) throws IOException
	{
		System.out.println("Start");
		String dir="D:\\";
		String url = "jdbc:mysql://localhost:3306/stockfalcon";
        String user = "root";
        String password = "";
        String ticker[]=new String[60];
        int i=0;
        
        try
        {
        	Class.forName("org.gjt.mm.mysql.Driver");
            Connection con = DriverManager.getConnection(url, user, password);
            Statement s=con.createStatement();
                    
			
            String query="SELECT * FROM `prediction` ";
            ResultSet rs = s.executeQuery(query);  
            while(rs.next())
            {
            	ticker[i]=rs.getString("stock_ticker");
            	ticker[i] = ticker[i].replaceAll("\\s","");
            	ticker[i]=ticker[i].concat(".NS");
            	System.out.println(" "+ticker[i]);
            	i++;
            }
            s.close();
            con.close();
            
        }
        catch (Exception e)
        {
            e.printStackTrace();
        }
		
		for(int j=0;j<i;j++)
		{
			Config  c=new Config(ticker[j]);
			
			File dataDir = new File(dir);
			MarketBuildTraining.generate(dataDir);
			MarketTrain.train(dataDir);
			MarketTrain.train(dataDir);
			MarketPrune.incremental(dataDir);
			MarketEvaluate.evaluate(dataDir);
		}
	
		
		Encog.getInstance().shutdown();
		
	}
}