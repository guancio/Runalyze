$Formular->setId('rechenspiele-calculator');
$Formular->addCSSclass('ajax');
$Formular->addCSSclass('no-automatic-reload');
$Formular->addFieldset( $Plugin->getFieldsetTRIMP(), false );
$Formular->addFieldset( $Plugin->getFieldsetVDOT(), false );
$Formular->addFieldset( $Plugin->getFieldsetBasicEndurance() );
$Formular->addFieldset( $Plugin->getFieldsetPaces(), false );
$Formular->allowOnlyOneOpenedFieldset();
