import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import javax.activation.*;

public class SendEmail
{
 public static void main(String [] args){
      String to = "nikhilrameshwar0114@gmail.com";//change accordingly
      String from = "luckyrameshwar0114@gmail.com";//change accordingly
      String host = "localhost";//or IP address

     //Get the session object
      Properties properties = System.getProperties();
      properties.put("mail.smtp.auth", "true");
      properties.put("mail.smtp.sterttils.enabel", "true");
      properties.put("mail.smtp.host", "smtp.gmail.com");
      properties.put("mail.smtp.port", "587");

      Session session = Session.getDefaultInstance(properties);

     //compose the message
      try{
         MimeMessage message = new MimeMessage(session);
         message.setFrom(new InternetAddress(from));
         message.addRecipient(Message.RecipientType.TO,new InternetAddress(to));
         message.setSubject("Ping");
         message.setText("Hello, this is example of sending email  ");

         // Send message
         Transport.send(message);
         System.out.println("message sent successfully....");

        }catch (MessagingException mex) {mex.printStackTrace();}
    }
}
