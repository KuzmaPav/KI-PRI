<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Seznam semestrů podle celkového počtu kreditních bodů</title>
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
        <h1>Seznam semestrů podle celkového počtu kreditních bodů</h1>
        
        <!-- Apply templates to select semesters -->
        <xsl:apply-templates select="//semestr">
          <!-- Sort semesters by total credits -->
          <xsl:sort select="sum(predmet/kredity)" data-type="number" order="descending"/>
        </xsl:apply-templates>

      </body>
    </html>
  </xsl:template>

  <!-- Match the 'semestr' element -->
  <xsl:template match="semestr">
    <xsl:variable name="rocnik" select="../@cislo"/>
    <h2><xsl:value-of select="$rocnik"/>. ročník - <xsl:value-of select="@nazev"/> semestr</h2>
    <p>Celkový počet kreditů: <xsl:value-of select="sum(predmet/kredity)"/></p>
    <table>
      <tr>
        <th>Název předmětu</th>
        <th>Vyučující</th>
        <th>Kredity</th>
        <th>Status</th>
        <th>Zakončení</th>
      </tr>
      <!-- Apply templates to 'predmet' elements -->
      <xsl:apply-templates select="predmet"/>
    </table>
  </xsl:template>

  <!-- Match the 'predmet' element -->
  <xsl:template match="predmet">
    <tr>
      <td><xsl:value-of select="nazev"/></td>
      <td><xsl:value-of select="vyucujici"/></td>
      <td><xsl:value-of select="kredity"/></td>
      <td><xsl:value-of select="status"/></td>
      <td><xsl:value-of select="zakonceni"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
