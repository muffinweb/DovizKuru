# DovizKuru | Merkez Bankasi | PHP
Merkez bankasindan json, array, object formatinda doviz kuru verileri

## Json Formatinda HTTP API
<code>
\Muffinweb\Kur::piyasasi();
</code>

## Array Formatinda PHP Veri

<code>
\Muffinweb\Kur::piyasasi(['type' => 'array']);
</code>

## Array Formatinda Degiskene Veri Atama
<code>
$kurlar = \Muffinweb\Kur::piyasasi(['type' => 'array', 'return', true]);
</code>
