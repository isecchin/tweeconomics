package tweeconomics;

package object utils
{
    implicit class StringImprovements(val substring: String) {
        def isSubstringOf(string: String) = string.toLowerCase().contains(substring.toLowerCase());
    }
}
