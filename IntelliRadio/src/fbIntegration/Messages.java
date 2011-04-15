package fbIntegration;
/*
 * FB account: Intelliradio Forall
 * Email: rasade88@gmail.com
 * Password: loto88
 * https://graph.facebook.com/oauth/authorize?client_id=195495487137724&redirect_uri=http://www.facebook.com/connect/login_success.html&type=user_agent&display=popup&scope=offline_access,read_mailbox
 */
import requestHandler.RequestQueue;
import java.net.*;
import java.io.*;
public class Messages {
    private static String fbAppSecret = "5cfac41ccd9679c8e03eaaa387b01cd8";
    private static String profileId = "100002306492505";
    //access key will be hardcoded
    private static String access_token = "195495487137724|ddb762bb76dcc6e99b27583b.1-100002306492505|GzXH5aBY9N2Dexc3KTYZ-_UyeBU";

    
    public RequestQueue getMessages() {
        RequestQueue messages = new RequestQueue();
        return messages;
    }
    /*
     * 
     * Hardcoded access key, no need to have this method
    public String getAccessKey() {
    	String url = "https://graph.facebook.com/oauth/authorize";
    	String charset = "UTF-8";
    	String client_id = "195495487137724";
    	String redirect_uri = "http://www.facebook.com/connect/login_success.html";
    	String type = "user_agent";
    	String display = "popup";
    	String scope = "offline_access,read_mailbox";
    	
    	String ver_code = "";
    	
    	try {
    		String query = String.format("client_id=%s&redirect_uri=%s&type=%s&display=%s&scope=%s", 
    				URLEncoder.encode(client_id, charset), 
    				URLEncoder.encode(redirect_uri, charset), 
    				URLEncoder.encode(type, charset), 
    				URLEncoder.encode(display, charset), 
    				URLEncoder.encode(scope, charset));
    				URLConnection connection = new URL(url + "?" + query).openConnection();
    				connection.setRequestProperty("Accept-Charset", charset);
    				InputStream response = connection.getInputStream();
    				ver_code = response.toString();
    	}
    	catch (Exception uee) {
    		System.out.println(uee.getMessage());
    	}
    	return ver_code;
    	
    } */
}
