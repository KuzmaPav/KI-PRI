<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <select name="predmet" id="predmet">
      <xsl:apply-templates select="//predmet"/>
    </select>
  </xsl:template>

  <xsl:template match="predmet">
    <option value="{@kod}">
      <xsl:value-of select="@kod"/> - <xsl:value-of select="nazev"/>
    </option>
  </xsl:template>

</xsl:stylesheet>
