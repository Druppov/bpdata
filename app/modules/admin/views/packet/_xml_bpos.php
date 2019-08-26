<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="POS_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="BPOS.POS_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="POS_NAME" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="30"><PARAM Name="ORIGIN" Value="BPOS.POS_NAME" Roundtrip="True"/></FIELD>
            <FIELD attrname="ADDR" fieldtype="string" SUBTYPE="FixedChar" WIDTH="120"><PARAM Name="ORIGIN" Value="BPOS.ADDR" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="BPOS.PUBLISHED" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW POS_ID="<?=$row->POS_ID?>" POS_NAME="<?=$row->POS_NAME?>" PUBLISHED="<?=$row->PUBLISHED?>"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>
