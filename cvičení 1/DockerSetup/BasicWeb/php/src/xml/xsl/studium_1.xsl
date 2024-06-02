<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Seznam předmětů</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
          }
          h1 {
            color: #333;
          }
          ul {
            list-style-type: disc;
            padding-left: 20px;
          }
          li {
            margin-bottom: 5px;
          }
        </style>
      </head>
      <body>
        <h1>Seznam předmětů</h1>
        <ul>
          <xsl:apply-templates select="//predmet" mode="subjectList"/>
        </ul>
      </body>
    </html>
  </xsl:template>

  <!-- Match the 'predmet' element for subject list -->
  <xsl:template match="predmet" mode="subjectList">
    <li>
      <xsl:value-of select="concat(@kod, ' - ', nazev)"/>
    </li>
  </xsl:template>

</xsl:stylesheet>
