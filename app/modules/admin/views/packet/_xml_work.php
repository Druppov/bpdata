<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="WORK_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="WORKS.WORK_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="WORKNAME" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="20"><PARAM Name="ORIGIN" Value="WORKS.WORKNAME" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="WORKS.PUBLISHED" Roundtrip="True"/></FIELD>
            <FIELD attrname="ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="WORKS.ID" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW WORK_ID="<?=$row->WORK_ID?>" WORKNAME="<?=$row->WORKNAME?>" PUBLISHED="P" ID="<?=$row->ID?>"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>
