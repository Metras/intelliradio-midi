package fbIntegration;
import requestHandler.RequestQueue;
import java.net.*;
import java.io.*;
public class Messages {
    private static String fbAppSecret;
    private static int profileId;
    private static String access_key;

    public void setAppSecret(String secret) {
        fbAppSecret = secret;
    }
    public void setProfileId(int id) {
        profileId = id;
    }
    public void setAccessKey(String key) {
        access_key = key;
    }
    public RequestQueue getMessages() {
        RequestQueue messages = new RequestQueue();
        return messages;
    }
    public String getAccessKey() {
    	String url = "https://graph.facebook.com/oauth/authorize";
    	String charset = "UTF-8";
    	String client_id = "195495487137724";
    	String redirect_uri = "http://www.facebook.com/connect/login_success.html";
    	String type = "user_agent";
    	String display = "popup";
    	String scope = "offline_access,read_mailbox";
    	
    	String ver_code = "";
    	// ...
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
    	
    }
}
