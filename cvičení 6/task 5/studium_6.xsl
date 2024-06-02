<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Tabulka předmětů podle semestrů (s počtem kreditů &gt; 2)</title>
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
        </style>
      </head>
      <body>
        <h1>Tabulka předmětů podle semestrů (s počtem kreditů &gt; 2)</h1>
        
        <!-- Apply templates to select semesters -->
        <xsl:apply-templates select="//semestr"/>

      </body>
    </html>
  </xsl:template>

  <!-- Match the 'semestr' element -->
  <xsl:template match="semestr">
    <h2><xsl:value-of select="@nazev"/> semestr</h2>
    <table>
      <tr>
        <th>Kód předmětu</th>
        <th>Název</th>
        <th>Vyučující</th>
        <th>Počet kreditů</th>
        <th>Status</th>
        <th>Zakončení</th>
      </tr>
      <!-- Apply templates to select subjects with credits greater than 2 -->
      <xsl:apply-templates select="predmet[number(kredity) &gt; 2]"/>
    </table>
  </xsl:template>

  <!-- Match the 'predmet' element -->
  <xsl:template match="predmet">
    <tr>
      <td><xsl:value-of select="@kod"/></td>
      <td><xsl:value-of select="nazev"/></td>
      <td><xsl:value-of select="vyucujici"/></td>
      <td><xsl:value-of select="kredity"/></td>
      <td><xsl:value-of select="status"/></td>
      <td><xsl:value-of select="zakonceni"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
