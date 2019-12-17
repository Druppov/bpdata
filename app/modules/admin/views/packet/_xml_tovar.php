<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="TOVAR_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY.TOVAR_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="NAME" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="60"><PARAM Name="ORIGIN" Value="TOVARY.NAME" Roundtrip="True"/></FIELD>
            <FIELD attrname="PRINTNAME" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="60"><PARAM Name="ORIGIN" Value="TOVARY.PRINTNAME" Roundtrip="True"/></FIELD>
            <FIELD attrname="TYPE_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY.TYPE_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="TAX_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY.TAX_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="ISACTIVE" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVARY.ISACTIVE" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVARY.PUBLISHED" Roundtrip="True"/></FIELD>
            <FIELD attrname="FKEY_1C" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY.FKEY_1C" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW TOVAR_ID="<?=$row->TOVAR_ID?>" NAME="<?=htmlspecialchars($row->NAME, ENT_COMPAT)?>" PRINTNAME="<?=htmlspecialchars($row->PRINTNAME, ENT_COMPAT)?>" TYPE_ID="<?=$row->TYPE_ID?>" TAX_ID="<?=$row->TAX_ID?>" ISACTIVE="<?=$row->ISACTIVE?>" PUBLISHED="P" FKEY_1C="<?=$row->FKEY_1C?>"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>
