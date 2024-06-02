<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Studium</title>
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
        <!-- Apply templates to the root element -->
        <xsl:apply-templates select="/*"/>
      </body>
    </html>
  </xsl:template>

  <!-- Match the 'studium' element -->
  <xsl:template match="studium">
    <h2>Studium</h2>
    <!-- Apply templates to 'rocnik' elements -->
    <xsl:apply-templates select="rocnik"/>
  </xsl:template>

  <!-- Match the 'rocnik' element -->
  <xsl:template match="rocnik">
    <h3>Rocnik <xsl:value-of select="@cislo"/></h3>
    <!-- Apply templates to 'semestr' elements -->
    <xsl:apply-templates select="semestr"/>
  </xsl:template>

  <!-- Match the 'semestr' element -->
  <xsl:template match="semestr">
    <h4><xsl:value-of select="@nazev"/> semestr</h4>
    <table>
      <tr>
        <th>Název předmětu</th>
        <th>Vyučující</th>
        <th>Kredity</th>
        <th>Status</th>
        <th>Zakončení</th>
        <th>Katedra</th>
      </tr>
      <!-- Apply templates to 'predmet' elements -->
      <xsl:apply-templates select="predmet"/>
    </table>
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
      <td><xsl:value-of select="nazev"/></td>
      <td><xsl:value-of select="vyucujici"/></td>
      <td><xsl:value-of select="kredity"/></td>
      <td><xsl:value-of select="status"/></td>
      <td><xsl:value-of select="zakonceni"/></td>
      <td><xsl:value-of select="@katedra"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
