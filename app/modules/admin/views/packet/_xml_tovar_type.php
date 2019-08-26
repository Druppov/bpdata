<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="TYPE_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVAR_TYPE.TYPE_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="TYPE_NAME" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="40"><PARAM Name="ORIGIN" Value="TOVAR_TYPE.TYPE_NAME" Roundtrip="True"/></FIELD>
            <FIELD attrname="SHOWASCATEGORY" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVAR_TYPE.SHOWASCATEGORY" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVAR_TYPE.PUBLISHED" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW TYPE_ID="<?=$row->TYPE_ID?>" TYPE_NAME="<?=$row->TYPE_NAME?>" SHOWASCATEGORY="<?=$row->SHOWASCATEGORY?>" PUBLISHED="P"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>
