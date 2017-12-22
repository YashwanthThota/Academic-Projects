<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>
<xsl:template match="/">
<html>
<body>
  <h1><center><xsl:value-of select="collection/description"/></center></h1>
  <xsl:for-each select="collection/recipe">
  <p><b>Recipe id: </b> <xsl:value-of select="./@id"/> </p>
  <h3>Title: <xsl:value-of select="./title"/> </h3>
  <p><b>Date: </b> <xsl:value-of select="./date"/></p>
  <h3>Ingredients</h3>
  <ul>
  <xsl:for-each select="ingredient">
    <li>
      <p><b>name: </b> <xsl:value-of select="./@name"/> <b> amount: </b> <xsl:value-of select="./@amount"/> <b> unit: </b> <xsl:value-of select="./@unit"/></p>
      <ul>
        <xsl:for-each select="ingredient">
          <li>
            <p><b>name: </b> <xsl:value-of select="./@name"/> <b> amount: </b> <xsl:value-of select="./@amount"/> <b> unit: </b> <xsl:value-of select="./@unit"/></p>
          </li>
          <ul>
            <xsl:for-each select="ingredient">
              <li>
                <p><b>name: </b> <xsl:value-of select="./@name"/> <b> amount: </b> <xsl:value-of select="./@amount"/> <b> unit: </b> <xsl:value-of select="./@unit"/></p>
              </li>
              <ul>
                <xsl:for-each select="ingredient">
                  <li>
                    <p><b>name: </b> <xsl:value-of select="./@name"/> <b> amount: </b> <xsl:value-of select="./@amount"/> <b> unit: </b> <xsl:value-of select="./@unit"/></p>
                  </li>
                </xsl:for-each>
              </ul>
            </xsl:for-each>
          </ul>
          <ol>
            <xsl:for-each select="preparation/step">
              <li>
                <xsl:value-of select="." />
              </li>
            </xsl:for-each>
          </ol>
        </xsl:for-each>
    </ul>
   <ol>
   <xsl:for-each select="preparation/step">
    <li>
      <xsl:value-of select="." />
    </li>
   </xsl:for-each>
 </ol>
  </li>
  </xsl:for-each>
    </ul>
    <h3>Preparation Steps:</h3>
    <ol>
      <xsl:for-each select="preparation/step">
        <li>
          <xsl:value-of select="." />
        </li>
      </xsl:for-each>
    </ol>
    <h3>Comments:</h3>
    <xsl:for-each select="comment">
      <li>
        <xsl:value-of select="." />
      </li>
    </xsl:for-each>
    <h3>Nutrition:</h3>
    <xsl:for-each select="nutrition">
      <p><b>calories: </b> <xsl:value-of select="./@calories"/> <b> fat: </b> <xsl:value-of select="./@fat"/> <b> carbohydrates: </b> <xsl:value-of select="./@carbohydrates"/> <b> protein: </b> <xsl:value-of select="./@protein"/></p>

    </xsl:for-each>
    <h3>Related:</h3>
    <xsl:for-each select="related">
      <li>
        <xsl:value-of select="." />
      </li>
    </xsl:for-each>
    <hr></hr>
  </xsl:for-each>

</body>
</html>
</xsl:template>
</xsl:stylesheet>
