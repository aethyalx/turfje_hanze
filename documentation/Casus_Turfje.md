# Turfje – Plan in het kort

Turfje wordt een app waarmee je je medicijnen kunt bijhouden (turven). Je maakt per medicijn een schema (bijv. elke dag om 08:00 en 20:00). De app stuurt je op het juiste moment een pushnotificatie met een herkenbaar geluid.

## Doel
Het doel is om minder medicijnen te vergeten, beter te documenteren wat je inneemt en wanneer, en dit inzicht te kunnen delen met een zorgverlener of familie.

## Kernfeatures (MVP)
- Medicijnen toevoegen met naam en dosering.
- Schema instellen: vaste tijden, herhalingen (dagelijks/wekelijks), start–einddatum.
- Pushnotificaties op ingestelde tijden, met custom geluidje.
- Afvinken (“ingenomen”) en een simpel dagoverzicht.

## Technisch lastigste deel
Het veilig stellen (encrypten) en opslaan van privégegevens zonder dat deze publiek toegankelijk zijn.

### Dit is lastig omdat:
- Er moet worden bepaald hoe medicijndata per user wordt opgeslagen (lokaal of server).
- Er moet worden nagedacht over omgang met privégebruikersdata.

## Technologieën (globaal)
- PHP (mogelijk Symfony)
- JSON
- Publieke API

## Prototype (globaal)
Het prototype laat zien dat een gebruiker medicijnen kan toevoegen, een innameschema kan instellen, pushmeldingen ontvangt en innames kan afvinken. Het dagoverzicht werkt en gegevens worden veilig en afgeschermd opgeslagen.

# Succescriteria
- Gebruiker kan medicijn + schema toevoegen en notificaties ontvangen.
- Afvinken werkt en het dagoverzicht toont ingenomen/gemiste innames.
- Gevoelige data is niet leesbaar in platte tekst (versleuteld/opgesloten).
- Alleen geautoriseerde personen kunnen data zien.
- Prototype is bruikbaar en begrijpelijk voor testgebruikers.
