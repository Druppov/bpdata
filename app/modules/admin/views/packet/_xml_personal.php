<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="PERSON_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="PERSONAL.PERSON_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="FIO" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="60"><PARAM Name="ORIGIN" Value="PERSONAL.FIO" Roundtrip="True"/></FIELD>
            <FIELD attrname="ISACTIVE" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="PERSONAL.ISACTIVE" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="PERSONAL.PUBLISHED" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW PERSON_ID="<?=$row->PERSON_ID?>" FIO="<?=$row->FIO?>" ISACTIVE="<?=$row->ISACTIVE?>" PUBLISHED="P"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>
