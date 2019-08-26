<? echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>

<DATAPACKET Version="2.0">
    <METADATA>
        <FIELDS>
            <FIELD attrname="POS_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.POS_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="TOVAR_ID" fieldtype="i4" required="true"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.TOVAR_ID" Roundtrip="True"/></FIELD>
            <FIELD attrname="PRICE_DATE" fieldtype="date" required="true"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.PRICE_DATE" Roundtrip="True"/></FIELD>
            <FIELD attrname="PRICE_VALUE" fieldtype="fixed" DECIMALS="2" WIDTH="18"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.PRICE_VALUE" Roundtrip="True"/></FIELD>
            <FIELD attrname="PUBLISHED" fieldtype="string" required="true" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.PUBLISHED" Roundtrip="True"/></FIELD>
            <FIELD attrname="ISUSED" fieldtype="string" SUBTYPE="FixedChar" WIDTH="1"><PARAM Name="ORIGIN" Value="TOVARY_PRICES.ISUSED" Roundtrip="True"/></FIELD>
        </FIELDS>
        <PARAMS/>
    </METADATA>
    <ROWDATA>
<? foreach ($rows as $row) {
?>
        <ROW POS_ID="<?=$row->POS_ID?>" TOVAR_ID="<?=$row->TOVAR_ID?>" PRICE_DATE="<?=Yii::$app->formatter->asDate($row->PRICE_DATE, 'yyyyMMdd')?>" PRICE_VALUE="<?=$row->PRICE_VALUE?>" PUBLISHED="P" ISUSED="<?=$row->ISUSED?>"/>
<? } //foreach ($rows as $row)
?>
    </ROWDATA>
</DATAPACKET>