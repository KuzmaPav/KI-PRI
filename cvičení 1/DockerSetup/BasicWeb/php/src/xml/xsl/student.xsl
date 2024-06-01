<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:template match="/">
    <html>
      <body>
        <h2>Student</h2>
        <table border="2">
          <tr bgcolor="#9acd32">
            <th style="text-align:left">STID</th>
            <th style="text-align:left">Name</th>
            <th style="text-align:left">Faculty</th>
          </tr>
          <xsl:for-each select="student">
            <tr>
              <td>
                <xsl:value-of select="@stid"/>
              </td>
              <td>
                <xsl:value-of select="name"/>
              </td>
              <td>
                <xsl:value-of select="faculty"/>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>