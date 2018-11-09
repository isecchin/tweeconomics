package tweeconomics

import scala.collection.mutable.HashMap

object DB
{
    val properties = new java.util.Properties
    var url = null

    def configure(credentials: HashMap[String, String]) = {
        val dbPropertyKeys = Seq("dbUrl", "dbUser", "dbPassword")

        dbPropertyKeys.foreach(key => {
            if (! credentials.contains(key)) {
                throw new Exception("Error setting DB credentials - value for " + key + " not found")
            }
        })

        properties.setProperty("driver", "com.mysql.cj.jdbc.Driver")
        properties.setProperty("user", credentials("dbUser"))
        properties.setProperty("password", credentials("dbPassword"))

        url = credentials("dbUrl")
    }
}
