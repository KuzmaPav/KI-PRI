<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Seznam předmětů v posledním semestru</title>
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
        <h1>Seznam předmětů v posledním semestru</h1>
        
        <!-- Original order -->
        <h2>Originální pořadí</h2>
        <table>
          <tr>
            <th>Kód předmětu</th>
            <th>Název</th>
            <th>Vyučující</th>
            <th>Počet kreditů</th>
            <th>Status</th>
            <th>Zakončení</th>
          </tr>
          <!-- Apply templates to select the subjects in the last semester -->
          <xsl:apply-templates select="//rocnik[last()]/semestr[last()]/predmet"/>
        </table>
        
        <!-- Ordered by subject code -->
        <h2>Seřazeno podle kódu předmětu</h2>
        <table>
          <tr>
            <th>Kód předmětu</th>
            <th>Název</th>
            <th>Vyučující</th>
            <th>Počet kreditů</th>
            <th>Status</th>
            <th>Zakončení</th>
          </tr>
          <!-- Apply templates to select and sort the subjects by subject code -->
          <xsl:apply-templates select="//rocnik[last()]/semestr[last()]/predmet">
            <xsl:sort select="@kod"/>
          </xsl:apply-templates>
        </table>
        
        <!-- Ordered by number of credits -->
        <h2>Seřazeno podle počtu kreditů</h2>
        <table>
          <tr>
            <th>Kód předmětu</th>
            <th>Název</th>
            <th>Vyučující</th>
            <th>Počet kreditů</th>
            <th>Status</th>
            <th>Zakončení</th>
          </tr>
          <!-- Apply templates to select and sort the subjects by number of credits -->
          <xsl:apply-templates select="//rocnik[last()]/semestr[last()]/predmet">
            <xsl:sort select="number(kredity)"/>
          </xsl:apply-templates>
        </table>
        
        <!-- Total credits -->
        <xsl:variable name="totalCredits">
          <xsl:value-of select="sum(//rocnik[last()]/semestr[last()]/predmet/kredity)"/>
        </xsl:variable>
        <p>Celkem kreditních bodů = <xsl:value-of select="$totalCredits"/></p>
        
      </body>
    </html>
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
