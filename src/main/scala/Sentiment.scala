package tweeconomics

object Sentiment extends Enumeration
{
    type Sentiment = Value
    val VERY_NEGATIVE, NEGATIVE, NEUTRAL, POSITIVE, VERY_POSITIVE = Value

    def toSentiment(sentiment: Int): Sentiment = sentiment match {
        case 0 => Sentiment.VERY_NEGATIVE
        case 1 => Sentiment.NEGATIVE
        case 2 => Sentiment.NEUTRAL
        case 3 => Sentiment.POSITIVE
        case 4 => Sentiment.VERY_POSITIVE
    }
}
