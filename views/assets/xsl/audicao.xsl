<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="1.0">
    
    <xsl:template match="/">
        <fo:root>
            <fo:layout-master-set>
                <fo:simple-page-master master-name="audicao" page-height="297mm" page-width="210mm">
                    <fo:region-body region-name="corpo" margin="2cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            <xsl:apply-templates />
        </fo:root>
    </xsl:template>
    
    <xsl:template match="audicao">
        <fo:page-sequence master-reference="audicao">
            <fo:flow flow-name="corpo">
                <fo:block font-size="12pt" background-color="red" color="white">
                    <fo:block space-after="1cm" space-before="1cm" />
                   
                    <fo:block font-size="28pt" text-align="center">
                        <xsl:value-of select="@id"/>::<xsl:value-of select="titulo"/>
                    </fo:block>
                    
                    <fo:block font-size="15pt" text-align="center">
                        <xsl:value-of select="subtitulo"/> 
                        (<fo:inline color="grey">
                            <xsl:value-of select="tema"/>
                        </fo:inline>)
                    </fo:block>
                    <fo:block space-after="1cm" space-before="1cm" />
                    <fo:block>
                        <fo:inline font-weight="bold">Organizador:</fo:inline>
                        <xsl:value-of select="organizador"/>
                    </fo:block>
                    <fo:block text-align-last="justify">
                        <fo:inline font-weight="bold">Data: </fo:inline>
                        <xsl:value-of select="data"/>
                        <fo:inline font-weight="bold">Hora: </fo:inline>
                        <xsl:value-of select="hora"/>
                        <fo:leader/>
                        <fo:inline font-weight="bold">Duração: </fo:inline>
                        <xsl:value-of select="duracao"/>
                        
                    </fo:block>
                    <fo:block space-after="0.5cm" space-before="0.5cm" />
                </fo:block>
                
                <fo:block text-align="center">
                    <fo:block space-after="0.3cm" space-before="0.3cm" />
                    <fo:inline font-weight="bold">Atuações</fo:inline>
                    
                </fo:block>
                <fo:block font-size="10pt">
                    <xsl:if test="//atuacao">
                    <fo:table xsl:use-attribute-sets="table.data">
                        
                        <fo:table-header>
                            <fo:table-row>
                                <fo:table-cell xsl:use-attribute-sets="table.data.th"><fo:block font-weight="bold">ID</fo:block></fo:table-cell>
                                <fo:table-cell xsl:use-attribute-sets="table.data.th"><fo:block font-weight="bold">Grupo</fo:block></fo:table-cell>
                                <fo:table-cell xsl:use-attribute-sets="table.data.th"><fo:block font-weight="bold">Nº de Alunos</fo:block></fo:table-cell>
                                <fo:table-cell xsl:use-attribute-sets="table.data.th"><fo:block font-weight="bold">Nº de Maestros</fo:block></fo:table-cell>
                                <fo:table-cell xsl:use-attribute-sets="table.data.th"><fo:block font-weight="bold">Nº de Obras</fo:block></fo:table-cell>
                            </fo:table-row>
                        </fo:table-header>
                        
                        <fo:table-body>
                            
                            <xsl:apply-templates select="atuacao" />
                            
                        </fo:table-body>
                        
                    </fo:table>
                    </xsl:if>
                </fo:block>
                
            </fo:flow>
        </fo:page-sequence>
    </xsl:template>
    
    <xsl:template match="atuacao">
        
        <fo:table-row>
            <fo:table-cell xsl:use-attribute-sets="table.data.td"><fo:block><xsl:value-of select="@id"/></fo:block></fo:table-cell>
            <fo:table-cell xsl:use-attribute-sets="table.data.td"><fo:block><xsl:value-of select="grupo"/></fo:block></fo:table-cell>       
            <fo:table-cell xsl:use-attribute-sets="table.data.td"><fo:block><xsl:value-of select="alunos"/></fo:block></fo:table-cell>        
            <fo:table-cell xsl:use-attribute-sets="table.data.td"><fo:block><xsl:value-of select="maestros"/></fo:block></fo:table-cell>      
            <fo:table-cell xsl:use-attribute-sets="table.data.td"><fo:block><xsl:value-of select="obras"/></fo:block></fo:table-cell>
        </fo:table-row>
        
    </xsl:template>
    
    <xsl:attribute-set name="table.data">
        <xsl:attribute name="table-layout">fixed</xsl:attribute>
        <xsl:attribute name="space-before">10pt</xsl:attribute>
        <xsl:attribute name="space-after">10pt</xsl:attribute>
    </xsl:attribute-set>
    
    <xsl:attribute-set name="table.data.th">
        <xsl:attribute name="background-color">#DDDDDD</xsl:attribute>
        <xsl:attribute name="border-style">solid</xsl:attribute>
        <xsl:attribute name="border-width">1pt</xsl:attribute>
        <xsl:attribute name="padding-start">0.3em</xsl:attribute>
        <xsl:attribute name="padding-end">0.2em</xsl:attribute>
        <xsl:attribute name="padding-before">2pt</xsl:attribute>
        <xsl:attribute name="padding-after">2pt</xsl:attribute>
    </xsl:attribute-set>
    
    <xsl:attribute-set name="table.data.td" >
        <xsl:attribute name="border-style">solid</xsl:attribute>
        <xsl:attribute name="border-width">1pt</xsl:attribute>
        <xsl:attribute name="padding-start">0.3em</xsl:attribute>
        <xsl:attribute name="padding-end">0.2em</xsl:attribute>
        <xsl:attribute name="padding-before">2pt</xsl:attribute>
        <xsl:attribute name="padding-after">2pt</xsl:attribute>
    </xsl:attribute-set>
</xsl:stylesheet>
