<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Předměty v prvním roce studia, zimní semestr</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
          }
          h1 {
            color: #333;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
          }
          th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
          }
          th {
            background-color: #f2f2f2;
          }
          .KI {
            background-color: #d9edf7; /* světle modrá */
          }
          .KMA {
            background-color: #dff0d8; /* světle zelená */
          }
          .KFY {
            background-color: #fcf8e3; /* světle žlutá */
          }
          .KCH {
            background-color: #f8d7da; /* světle červená */
          }
        </style>
      </head>
      <body>
        <h1>Předměty v prvním roce studia, zimní semestr</h1>
        <table>
          <tr>
            <th>Kód předmětu</th>
            <th>Počet kreditů</th>
            <th>Vyučující</th>
            <th>Status</th>
            <th>Zakončení</th>
          </tr>
          <!-- Apply templates to select 'predmet' elements -->
          <xsl:apply-templates select="//rocnik[@cislo='1']/semestr[@nazev='zimni']/predmet"/>
        </table>
      </body>
    </html>
  </xsl:template>

  <!-- Match the 'predmet' element -->
  <xsl:template match="predmet">
    <tr>
      <!-- Conditional class based on katedra -->
      <xsl:attribute name="class">
        <xsl:choose>
          <xsl:when test="@katedra = 'KI'">KI</xsl:when>
          <xsl:when test="@katedra = 'KMA'">KMA</xsl:when>
          <xsl:when test="@katedra = 'KFY'">KFY</xsl:when>
          <xsl:when test="@katedra = 'KCH'">KCH</xsl:when>
          <xsl:otherwise>KI</xsl:otherwise> <!-- Default class if none match -->
        </xsl:choose>
      </xsl:attribute>
      <td><xsl:value-of select="@kod"/></td>
      <td><xsl:value-of select="kredity"/></td>
      <td><xsl:value-of select="vyucujici"/></td>
      <td><xsl:value-of select="status"/></td>
      <td><xsl:value-of select="zakonceni"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
