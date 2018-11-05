package tweeconomics

import org.apache.log4j.{Logger => Logger4j}
import org.apache.log4j.{Level  => Level4j}

object Logger {
    def setup() {
        Logger4j.getLogger("org").setLevel(Level4j.ERROR)
        Logger4j.getLogger("akka").setLevel(Level4j.ERROR)
    }
}
