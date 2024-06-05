<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html>
            <head>
                <title><xsl:value-of select="form/@title"/></title>
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
            </head>
            <body>
                <div class="container mt-5">
                    <h1 class="mb-4"><xsl:value-of select="form/@title"/></h1>
                    <form id="dynamicForm">
                        <xsl:for-each select="form/questions/question">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <xsl:value-of select="question_text"/>
                                </label>
                                <xsl:if test="@type = 'text'">
                                    <input type="text" name="question{position()}" class="form-control" />
                                </xsl:if>
                                <xsl:if test="@type = 'checkbox'">
                                    <div class="form-check">
                                        <xsl:for-each select="options/option">
                                            <input type="checkbox" name="question{position()}[]" value="{.}" class="form-check-input"/>
                                            <label class="form-check-label">
                                                <xsl:value-of select="."/>
                                            </label>
                                            <br/>
                                        </xsl:for-each>
                                    </div>
                                </xsl:if>
                                <xsl:if test="@type = 'radiobox'">
                                    <xsl:variable name="questionName" select="concat('question', position())"/>
                                    <div class="form-check">
                                        <xsl:for-each select="options/option">
                                            <input type="radio" name="{$questionName}" value="{.}" class="form-check-input"/>
                                            <label class="form-check-label">
                                                <xsl:value-of select="."/>
                                            </label>
                                            <br/>
                                        </xsl:for-each>
                                    </div>
                                </xsl:if>
                            </div>
                        </xsl:for-each>
                    </form>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
