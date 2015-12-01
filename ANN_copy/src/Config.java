	

import org.encog.ml.data.market.TickerSymbol;
/**
* Basic config info for the market prediction example.
*
* @author jeff
*
*/
public class Config 
{
	public static final String TRAINING_FILE = "marketData.egb";
	public static final String NETWORK_FILE = "marketNetwork.eg";
	public static final int TRAINING_MINUTES = 2;
	public static final int HIDDEN1_COUNT = 21;
	public static final int HIDDEN2_COUNT = 21;
	public static final int INPUT_WINDOW =10;
	public static final int PREDICT_WINDOW = 1;
	public static  TickerSymbol TICKER ;
	public Config(String t) 
	{
		TICKER = new TickerSymbol(t);
	}
}