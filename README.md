# Functioneel ontwerp Turfje

## Doel
Dit document beschrijft het functioneel ontwerp voor de applicatie Turfje. Het doel van de applicatie is om patiënten te helpen met hun medicijnen. Ook moet het de behandelaar inzicht geven in het medicijngebruik van de patiënten.
Het document geeft een overzicht van functionele wensen van de gebruiker. Dit dient daarom ook gebruikt te worden als leidraad voor de ontwikkeling van de applicatie.

## Gebruikers en rollen
De applicatie kent de volgende rollen:
- Patiënt – Dit is de hoofdgebruiker van de applicatie. De patiënt houdt in de applicatie zijn medicijngebruik bij.
- Behandelaar – Deze gebruiker zal het medicijngebruik van zijn/haar patiënten kunnen inzien.
- Administrator – Deze rol is er voor gebruikersbeheer en systeemonderhoud.

## Scope

### Binnen scope
Turfje zal de volgende onderdelen ondersteunen:
- Het inloggen in de applicatie als patiënt of behandelaar.
- Het bijhouden van medicijninname van de patiënt via een turfsysteem.
- Het maken van een schema om te bepalen wanneer medicijnen ingenomen dienen te worden.
- Deze gegevens inzichtelijk maken voor de behandelende arts.
- Het versturen van een herinnering om te patiënt te helpen bij het tijdig gebruiken van de medicijnen.
- Een connectie met een externe medicijnendatabase om patiënten eenvoudig informatie te kunnen bieden over hun medicijnen.
- Een patiënt kan berichten achterlaten die de arts kan lezen. Bijvoorbeeld het beschrijven van klachten of bijwerkingen bij bepaalde medicijnen.
- De mogelijkheid bieden voor een behandelaar om feedback te geven op berichten van de patiënt.

### Buiten scope
Wat Turfje niet zal doen is als volgt:
- Advies geven over medicijngebruik
- Recepten of herhaalrecepten opvragen bij de apotheek.
- Directe koppeling leggen met de verzekering.
- Het betalen van medicijnen.
- Integratie met slimme pillendoosjes of andere hardware
- Het delen van patiëntgegevens met derden anders dan de behandelaar.

## Use Cases
[Hier diagrammen, stroomschema’s of andere procesflow-afbeeldingen]

## Features
[Features om de applicatie te kunnen gebruiken. Dus wat moet er zijn om de verschillende use-cases probleemloos te kunnen doorlopen.]

### 1 - Medicijninformatie raadplegen
**Beschrijving**  
Turfje biedt de mogelijkheid aan de patiënt om actuele en betrouwbare informatie over medicijnen op te zoeken en te bekijken. Hierdoor hoeven ze geen informatie uit externe bronnen te halen.

**Functionele eisen**

**Must have**  
- E1 – De patiënt kan met een zoekfunctie medicijnen opzoeken op naam
- E2 – De patiënt kan de gevonden informatie raadplegen. Bijvoorbeeld bijwerkingen, dosering, en gebruiksinstructies.

**Nice to have**  
- E3 – De patiënt kan geselecteerde medicijninformatie opslaan als favoriet.
- E4 – De patiënt kan geselecteerde medicijninformatie downloaden in PDF-formaat.

## Randvoorwaarden
[Performance en toegankelijkheid waar de applicatie op zijn minst aan moet voldoen om acceptabel te zijn.]
