
import javax.xml.xpath.*;
import org.xml.sax.InputSource;
import org.w3c.dom.*;

class Xpath {

    static void print ( Node e ) {
	if (e instanceof Text)
	    System.out.print(((Text) e).getData());
	else {
	    NodeList c = e.getChildNodes();
	    System.out.print("<"+e.getNodeName());
	    NamedNodeMap attributes = e.getAttributes();
	    for (int i = 0; i < attributes.getLength(); i++)
		System.out.print(" "+attributes.item(i).getNodeName()
				 +"=\""+attributes.item(i).getNodeValue()+"\"");
	    System.out.print(">");
	    for (int k = 0; k < c.getLength(); k++)
		print(c.item(k));
	    System.out.print("</"+e.getNodeName()+">");
	}
    }

    static void eval ( String query, String document ) throws Exception {
	XPathFactory xpathFactory = XPathFactory.newInstance();
	XPath xpath = xpathFactory.newXPath();
	InputSource inputSource = new InputSource(document);
	NodeList result = (NodeList) xpath.evaluate(query,inputSource,XPathConstants.NODESET);
	System.out.println("XPath query: "+query);
	for (int i = 0; i < result.getLength(); i++)
	    print(result.item(i));
	System.out.println();
    }

    public static void main ( String[] args ) throws Exception {
		System.out.println("query1: Print the titles of all articles whose one of the authors is David Maier \n ");
		String xPathExp1 = ("/SigmodRecord/issue/articles/article[authors/author='David Maier']/title");
		eval(xPathExp1,"SigmodRecord.xml");
		System.out.println("\n");
		System.out.println("query2: Print the titles of all articles whose first author is David Maier. \n ");
		String xPathExp2 = ("//issue/articles/article[authors/author[text()='David Maier' and @position='00']]/title");
		eval(xPathExp2,"SigmodRecord.xml");
		System.out.println("\n");
		System.out.println("query3: Print the titles of all articles whose authors include David Maier and Stanley B. Zdonik. \n ");
		String xPathExp3 = ("//issue/articles/article[authors/author='David Maier' and authors/author='Stanley B. Zdonik']/title");
		eval(xPathExp3,"SigmodRecord.xml");
		System.out.println("\n");
		System.out.println("query4: Print the titles of all articles in volume 19/number 2. \n ");
		String xPathExp4 = ("//issue[volume='19' and number='2']/articles/article/title");
		eval(xPathExp4,"SigmodRecord.xml");
		System.out.println("\n");
		System.out.println("query5: Print the titles and the init/end pages of all articles in volume 19/number 2 whose authors include Jim Gray.\n ");
    String xPathExp5 = ("//issue[volume='19' and number='2']/articles/article[authors/author='Jim Gray']/*[self::title or self::initPage or self::endPage]");
		eval(xPathExp5,"SigmodRecord.xml");
		System.out.println("\n");
		System.out.println("query6: Print the volume and number of all articles whose authors include David Maier. \n ");
		String xPathExp6 = ("//issue[articles/article/authors/author='David Maier']/*[self:: volume or self:: number]");
		eval(xPathExp6,"SigmodRecord.xml");
		//System.out.println("\n");

    }
}
