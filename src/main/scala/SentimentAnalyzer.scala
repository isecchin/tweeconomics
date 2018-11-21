package tweeconomics

import java.util.Properties

import edu.stanford.nlp.ling.CoreAnnotations
import edu.stanford.nlp.neural.rnn.RNNCoreAnnotations
import edu.stanford.nlp.pipeline.{Annotation, StanfordCoreNLP}
import edu.stanford.nlp.sentiment.SentimentCoreAnnotations

import scala.collection.convert.wrapAll._

object SentimentAnalyzer
{
    val props = new Properties()
    props.setProperty("annotators", "tokenize, ssplit, parse, sentiment")
    props.setProperty("tokenize.options", "untokenizable=noneKeep")
    val pipeline: StanfordCoreNLP = new StanfordCoreNLP(props)

    def mainSentiment(input: String): Int = Option(input) match {
        case Some(text) if !text.isEmpty => extractSentiment(text)
        case _ => throw new IllegalArgumentException("input can't be null or empty")
    }

    private def extractSentiment(text: String): Int = {
        val (_, sentiment) = extractSentiments(text)
            .maxBy{case (sentence, _) => sentence.length}
        sentiment
    }

    def extractSentiments(text: String): List[(String, Int)] = {
        val annotation: Annotation = pipeline.process(text)
        val sentences = annotation.get(classOf[CoreAnnotations.SentencesAnnotation])
        sentences
            .map(sentence => (sentence, sentence.get(classOf[SentimentCoreAnnotations.SentimentAnnotatedTree])))
            .map{case (sentence, tree) => (sentence.toString, RNNCoreAnnotations.getPredictedClass(tree))}
            .toList
    }
}
