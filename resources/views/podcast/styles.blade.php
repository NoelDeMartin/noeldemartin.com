<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>

<xsl:stylesheet
    version="1.0"
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:atom="http://www.w3.org/2005/Atom"
>
    <xsl:output method="html" indent="no" omit-xml-declaration="yes" />
    <xsl:template match="channel">
        <html>
            <head>
                <meta charset="utf-8" />
                <meta
                    name="viewport"
                    content="width=device-width, initial-scale=1"
                />
                <title><xsl:value-of select="title" /></title>
                @vite('resources/assets/css/main.css')
            </head>
            <body class="bg-gray-50">
                <div class="mx-auto max-w-prose px-6 py-8">
                    <div class="flex items-center">
                        <div class="rounded p-2" style="background: #ff6600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 430.117 430.118"
                                class="size-6 text-white"
                            >
                                <path
                                    style="fill: currentColor"
                                    d="M97.493,332.473c10.419,10.408,16.755,24.525,16.794,40.244c-0.04,15.687-6.375,29.809-16.755,40.17l-0.04,0.019
                                    c-10.398,10.352-24.603,16.681-40.398,16.681c-15.775,0-29.944-6.348-40.34-16.699C6.384,402.526,0,388.422,0,372.717
                                    c0-15.719,6.384-29.869,16.754-40.253v0.009c10.401-10.36,24.57-16.735,40.34-16.735C72.89,315.738,87.081,322.131,97.493,332.473z
                                    M97.493,332.464v0.009c0.019,0,0.019,0,0.019,0L97.493,332.464z M16.754,412.906c0,0,0,0,0-0.019c-0.019,0-0.019,0-0.019,0
                                    L16.754,412.906z M0.046,146.259v82.129c53.618,0.033,104.328,21.096,142.278,59.104c37.943,37.888,58.917,88.675,59.003,142.477
                                    h0.028v0.149h82.467c-0.065-78.233-31.866-149.099-83.279-200.549C149.122,178.126,78.285,146.308,0.046,146.259z M0.196,0v82.089
                                    c191.661,0.14,347.464,156.184,347.594,348.028h82.327c-0.056-118.571-48.248-225.994-126.132-303.932
                                    C226.073,48.274,118.721,0.051,0.196,0z"
                                />
                            </svg>
                        </div>

                        <h1 class="ml-2 text-3xl font-semibold">
                            <xsl:value-of select="title" />
                        </h1>
                    </div>

                    <p class="mt-4"><xsl:value-of select="description" /></p>

                    <div class="space-y-4 pt-2">
                        <xsl:for-each select="item">
                            <div class="rounded border bg-white px-8 py-4">
                                <h2 class="text-xl font-semibold">
                                    <xsl:value-of select="title" />
                                </h2>
                                <audio class="mt-4">
                                    <xsl:attribute name="src">
                                        <xsl:value-of
                                            select="enclosure/@url"
                                        />
                                    </xsl:attribute>
                                    <xsl:attribute name="preload">
                                        metadata
                                    </xsl:attribute>
                                    <xsl:attribute
                                        name="controls"
                                    ></xsl:attribute>
                                </audio>
                                <div class="prose mt-4 text-sm">
                                    <xsl:value-of
                                        select="description"
                                        disable-output-escaping="yes"
                                    />
                                </div>
                            </div>
                        </xsl:for-each>
                    </div>

                    <hr class="mt-2" />
                    <p class="mt-2">
                        Use the following url to listen in your favourite
                        podcast app:
                    </p>
                    <pre class="mt-2 rounded bg-gray-200 p-2">
                        <code><xsl:value-of select="atom:link/@href"/></code>
                    </pre>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
