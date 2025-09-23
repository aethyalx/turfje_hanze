# Functioneel Ontwerp Turfje

## Doel
Dit document beschrijft het functioneel ontwerp voor de applicatie **Turfje**.  
Het doel van de applicatie is om patiënten te helpen met hun medicijnen. Ook moet het de behandelaar inzicht geven in het medicijngebruik van de patiënten.  

Het document geeft een overzicht van functionele wensen van de gebruiker en dient als leidraad voor de ontwikkeling van de applicatie.

## Gebruikers en Rollen
De applicatie kent de volgende rollen:

- **Patiënt** – Hoofdgebruiker van de applicatie; houdt zijn medicijngebruik bij.  
- **Behandelaar** – Kan het medicijngebruik van zijn/haar patiënten inzien.  
- **Administrator** – Voor gebruikersbeheer en systeemonderhoud.  

## Scope

### Binnen scope
Turfje zal de volgende onderdelen ondersteunen:

- Inloggen in de applicatie als patiënt of behandelaar.  
- Bijhouden van medicijninname van de patiënt via een turfsysteem.  
- Maken van een schema om te bepalen wanneer medicijnen ingenomen dienen te worden.  
- Deze gegevens inzichtelijk maken voor de behandelende arts.  
- Versturen van herinneringen om de patiënt te helpen bij het tijdig gebruiken van medicijnen.  
- Connectie met een externe medicijnendatabase om informatie over medicijnen te bieden.  
- Patiënt kan berichten achterlaten voor de arts (bijvoorbeeld klachten of bijwerkingen).  
- Behandelaar kan feedback geven op berichten van de patiënt.  

### Buiten scope
Turfje zal niet doen:

- Advies geven over medicijngebruik  
- Recepten of herhaalrecepten opvragen bij de apotheek  
- Directe koppeling met de verzekering  
- Betalen van medicijnen  
- Integratie met slimme pillendoosjes of andere hardware  
- Delen van patiëntgegevens met derden anders dan de behandelaar  

## Use Cases
*Hier diagrammen, stroomschema’s of andere procesflow-afbeeldingen invoegen.*

## Features
*Features om de applicatie te kunnen gebruiken en de verschillende use-cases probleemloos door te lopen.*

### 1 - Medicijninformatie raadplegen
**Beschrijving:**  
Turfje biedt de mogelijkheid aan de patiënt om actuele en betrouwbare informatie over medicijnen op te zoeken en te bekijken. Hierdoor hoeven ze geen informatie uit externe bronnen te halen.

**Functionele eisen:**

**Must have**  
- E1 – De patiënt kan met een zoekfunctie medicijnen opzoeken op naam  
- E2 – De patiënt kan de gevonden informatie raadplegen (bijwerkingen, dosering, gebruiksinstructies)  

**Nice to have**  
- E3 – De patiënt kan geselecteerde medicijninformatie opslaan als favoriet  
- E4 – De patiënt kan geselecteerde medicijninformatie downloaden in PDF-formaat  

## Randvoorwaarden
*Performance en toegankelijkheid waar de applicatie op zijn minst aan moet voldoen om acceptabel te zijn.*
