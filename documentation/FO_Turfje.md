# Functioneel Ontwerp - Turfje

## Doel
Dit document beschrijft het functioneel ontwerp voor de applicatie **Turfje**.
Het doel van de applicatie is om patiënten te helpen met hun medicijnen. Ook moet het de behandelaar inzicht geven in het medicijngebruik van de patiënten.

Turfje wordt ontwikkeld omdat er momenteel geen applicatie bestaat die medicijngebruik en planning combineert met het delen van deze gegevens met een behandelaar.

Het document geeft een overzicht van functionele wensen van de gebruiker. Dit dient daarom ook gebruikt te worden als leidraad voor de ontwikkeling van de applicatie.

---

## Gebruikers en Rollen

De applicatie kent de volgende rollen:

- **Patiënt** – Dit is de hoofdgebruiker van de applicatie. De patiënt houdt in de applicatie zijn medicijngebruik bij.
- **Behandelaar** – Deze gebruiker kan het medicijngebruik (turven) van zijn/haar patiënten inzien, schema’s opstellen, medicijnen koppelen en feedback geven.
- **Administrator** – Deze rol biedt technische hulp en voert systeemonderhoud uit.

---

## Scope

### Binnen scope
Turfje zal de volgende onderdelen ondersteunen:
- Inloggen als patiënt, behandelaar of administrator.
- Bijhouden van medicijninname via een turfsysteem.
- Maken van medicatieschema’s.
- Gegevens inzichtelijk maken voor de behandelende arts.
- Versturen van herinneringen voor medicijninname.
- Connectie met externe medicijnendatabase.
- Berichtenuitwisseling tussen patiënt en behandelaar.
- Feedbackfunctionaliteit van behandelaar naar patiënt.

### Buiten scope
Wat Turfje **niet** zal doen:
- Advies geven over medicijngebruik.
- Recepten aanvragen bij apotheek.
- Koppeling met verzekering.
- Betaling van medicijnen.
- Integratie met slimme pillendoosjes of hardware.
- Delen van patiëntgegevens met derden.

---

## Requirements

### Algemene Gebruiker
| Wensnummer | Beschrijving | Prioriteit | Geschatte grootte |
|-------------|---------------|-------------|--------------------|
| T1 | Inloggen in de applicatie om persoonlijke gegevens in te zien en op te slaan. | 1 |  |
| T3 | Andere gebruikers koppelen aan mijn account zodat zij mijn gegevens kunnen zien. | 1 |  |
| T2 | Accountgegevens kunnen aanpassen of verwijderen. | 2 |  |

---

### Behandelaar
| Wensnummer | Beschrijving | Prioriteit | Geschatte grootte |
|-------------|---------------|-------------|--------------------|
| T5 | Schema voor de patiënt opstellen. | 1 |  |
| T6 | Medicijnen toevoegen aan de patiënt. | 1 |  |
| T7 | Medicijngebruik (turven/schemas) van patiënten inzien. | 1 |  |
| T4 | Direct feedback kunnen geven aan patiënten. | 3 |  |

---

### Patiënt
| Wensnummer | Beschrijving | Prioriteit | Geschatte grootte |
|-------------|---------------|-------------|--------------------|
| T10 | Bijhouden hoe vaak medicijnen zijn ingenomen. | 1 |  |
| T11 | Schema kunnen opstellen voor medicijngebruik. | 1 |  |
| T8 | Medicatiegegevens kunnen opzoeken. | 2 |  |
| T13 | Reminder ontvangen vóór medicijninname. | 2 |  |
| T14 | Reminder ontvangen bij medicijninname. | 2 |  |
| T9 | Medicijninformatie kunnen bewaren. | 3 |  |
| T12 | Feedback kunnen geven aan behandelaar. | 3 |  |
| T15 | Inzien bij welke apotheek medicijnen verkrijgbaar zijn. | 3 |  |

---

### Administrator
| Wensnummer | Beschrijving | Prioriteit | Geschatte grootte |
|-------------|---------------|-------------|--------------------|
| T16 | Gebruikers kunnen beheren (rechten, wachtwoorden, accounts). | 1 |  |
| T17 | Applicatiedata kunnen beheren (medische en gebruikersgegevens). | 1 |  |
| T18 | Overzichtspagina voor beheertaken. | 1 |  |

---

### Toelichting Prioriteit
1 = Must have – Nodig voor basisfunctionaliteit.
2 = Should have – Maakt de applicatie gebruiksvriendelijker.
3 = Nice to have – Extra toevoeging.

---

## Use Cases
_Hier komen diagrammen, stroomschema’s of procesflows._

---

## Features

### F1 – Gebruikersbeheer

#### Beschrijving
Functionaliteit voor registratie, inloggen, gegevensbeheer en koppeling tussen gebruikers.

#### Sub-features

**T0 – Registreren account**
- Gebruiker maakt account aan met e-mailadres, wachtwoord en rol.

**T1 – Inloggen functionaliteit**
- Login-scherm met invoervelden voor e-mail en wachtwoord.
- Homepagina per rol.
- "Wachtwoord vergeten" functionaliteit.

**T2 – Account verwijderen/deactiveren**
- Gebruiker kan account laten verwijderen of tijdelijk deactiveren.

**T3 – Koppelen accounts**
- Patiënt kan unieke koppelcode genereren en delen met behandelaar of andere gebruiker.
- Mogelijkheid koppelingen te beëindigen.

**T16 – Gebruikers beheren (Admin)**
- Dashboard met overzicht van gebruikers.
- Rechten aanpassen, wachtwoord resetten, accounts verwijderen of uitschakelen.
- Mogelijkheid PSK resetten.

**T17 – Beheeromgeving met overzicht (Admin)**
- Dashboard met zoekfunctie op gebruikersnaam.
- Alle beheeropties per gebruiker zichtbaar (reset, verwijderen, koppelen, PSK reset).

---

### F2 – Schema’s en Turven

#### Beschrijving
Patiënt en behandelaar kunnen medicatieschema’s aanmaken, beheren en medicijninname registreren.

#### Sub-features
**T6 – Medicijnen toevoegen**
- Patiënt en behandelaar kunnen medicijnen toevoegen of verwijderen.

**T11 / T5 – Medicatieschema opstellen**
- Schema met medicijnnaam, dosering, tijdstip, duur en herhaling.
- Weergave in kalender, mogelijkheid pauzeren of verwijderen.

**T10 / T7 – Innamegeschiedenis bijhouden**
- Turfsysteem om medicijngebruik te registreren.
- Inzicht in gebruikspatronen, statistieken (per week/maand), export als CSV.
- Behandelaar kan gebruikspatronen van gekoppelde patiënten inzien.

---

### F3 – Medicatie Informatie

#### Beschrijving
Raadplegen en opslaan van medicatiegegevens, inclusief apotheekinformatie.

#### Sub-features

**T8 – Medicatiegegevens opzoeken**
- Zoeken op medicijnnaam of merknaam.
- Weergave: naam, dosering, werkzame stoffen, bijwerkingen, bijsluiter.

**T9 – Medicijninformatie bewaren**
- Medicijn toevoegen aan "Mijn Medicijnen".
- Zoeken en verwijderen binnen opgeslagen medicijnen.

**T15 – Apotheekinformatie**
- Lijst met apotheken die medicijn verkopen.
- Zoeken op postcode of apotheeknaam.

---

### F4 – Notificaties en Herinneringen

#### Beschrijving
Herinneringen sturen voor medicijninname.

#### Sub-features

**T14 – Reminder bij tijd voor inname**
- Melding bij tijdstip van medicijninname.
- Bevestiging mogelijk.
- Herhaalmelding na 15 minuten indien geen bevestiging.

**T13 – Reminder bij bijna tijd voor inname**
- Notificatie instellen (bijv. 15 minuten vooraf).
- Per medicijn instelbaar.

---

### F5 – Feedback

#### Beschrijving
Patiënt en behandelaar kunnen feedback delen over medicijngebruik.

#### Sub-features

**T12 / T4 – Feedback**
- Patiënt kan formulier invullen met bijwerkingen of opmerkingen.
- Feedback zichtbaar voor gekoppelde accounts.
- Behandelaar kan reageren op feedback.

---

## Wireframe / Mockup
### Intro
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/1-Intro.png" alt="Intro" width="500"/>

### Inloggen
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/2-Login.png" alt="Intro" width="500"/>

### Registreren
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/3-Registreren.png" alt="Intro" width="500"/>

### Dashboard
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/4-Dashboard.png" alt="Intro" width="500"/>

### Instellingen
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/5-Instellingen.png" alt="Intro" width="500"/>

### Schemas
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/6-Schemas.png" alt="Intro" width="500"/>

### Medicijnen
<img src="https://r2.fivemanage.com/wqMuL8aYWTwEuuMyYBW4d/7-Medicijnen.png" alt="Intro" width="500"/>

## Randvoorwaarden
_De applicatie moet voldoen aan minimale eisen voor performance, toegankelijkheid en veiligheid._
