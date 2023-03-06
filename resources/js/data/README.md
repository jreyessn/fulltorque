HKN Daten : https://apps.evu-solutions.ch:4434/data/landing 

Login Prozess

1. --> GET  https://apps.evu-solutions.ch:4434/Account/Login -> Aus dem Html Token holen <input name='__RequestVerificationToken' value='???'> 
2. --> POST  https://apps.evu-solutions.ch:4434/Account/Login post Daten: "__RequestVerificationToken=???&Email=info@qlick.ch&Password=StrommarktLight1!" --> Auth Cookie wird gesetzt.
3. --> GET https://apps.evu-solutions.ch:4434/TI/Home/GetData?key=0 --> für Jahresproduktegrafik  (Jahresproduktegrafik = 0, Quartalsproduktegrafik = 1, EURO = 2,  Jahrespreise = 3,  Quartalspreise = 4,  Monatpreise = 5,  Preise = 6,  PreisDifferenz = 7,  WeitereProdukte = 8,  Spotmarktpreise = 9)