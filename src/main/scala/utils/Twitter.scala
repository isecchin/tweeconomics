package tweeconomics

import scala.collection.mutable.HashMap

object Twitter
{
    def configure(credentials: HashMap[String, String]) = {
        val configKeys = Seq("consumerKey", "consumerSecret", "accessToken", "accessTokenSecret")
        Logger.info("Configuring Twitter OAuth...")

        configKeys.foreach(key => {
            if (! credentials.contains(key)) {
                throw new Exception("Error setting Twitter OAuth authenticaion - value for " + key + " not found")
            }
            val fullKey = "twitter4j.oauth." + key
            System.setProperty(fullKey, credentials(key))
            Logger.info("\tProperty " + fullKey + " set as " + credentials(key))
        })
    }

}
