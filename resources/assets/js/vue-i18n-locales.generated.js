export default {
    "de": {
        "actions": {
            "create": "Erstellen",
            "edit": "Editieren",
            "delete": "Löschen"
        },
        "calendar": {
            "months": {
                "1": "Januar",
                "2": "Februar",
                "3": "März",
                "4": "April",
                "5": "Mai",
                "6": "Juni",
                "7": "Juli",
                "8": "August",
                "9": "September",
                "10": "Oktober",
                "11": "November",
                "12": "Dezember"
            },
            "weekdays": [
                "Montag",
                "Dienstag",
                "Mittwoch",
                "Donnerstag",
                "Freitag",
                "Samstag",
                "Sonntag"
            ]
        },
        "validation": {
            "accepted": "{attribute} muss akzeptiert werden.",
            "active_url": "{attribute} ist keine gültige Internet-Adresse.",
            "after": "{attribute} muss ein Datum nach dem {date} sein.",
            "after_or_equal": "{attribute} muss ein Datum nach dem {date} oder gleich dem {date} sein.",
            "alpha": "{attribute} darf nur aus Buchstaben bestehen.",
            "alpha_dash": "{attribute} darf nur aus Buchstaben, Zahlen, Binde- und Unterstrichen bestehen.",
            "alpha_num": "{attribute} darf nur aus Buchstaben und Zahlen bestehen.",
            "array": "{attribute} muss ein Array sein.",
            "before": "{attribute} muss ein Datum vor dem {date} sein.",
            "before_or_equal": "{attribute} muss ein Datum vor dem {date} oder gleich dem {date} sein.",
            "between": {
                "numeric": "{attribute} muss zwischen {min} & {max} liegen.",
                "file": "{attribute} muss zwischen {min} & {max} Kilobytes groß sein.",
                "string": "{attribute} muss zwischen {min} & {max} Zeichen lang sein.",
                "array": "{attribute} muss zwischen {min} & {max} Elemente haben."
            },
            "boolean": "{attribute} muss entweder 'true' oder 'false' sein.",
            "confirmed": "{attribute} stimmt nicht mit der Bestätigung überein.",
            "date": "{attribute} muss ein gültiges Datum sein.",
            "date_equals": "The {attribute} must be a date equal to {date}.",
            "date_format": "{attribute} entspricht nicht dem gültigen Format für {format}.",
            "different": "{attribute} und {other} müssen sich unterscheiden.",
            "digits": "{attribute} muss {digits} Stellen haben.",
            "digits_between": "{attribute} muss zwischen {min} und {max} Stellen haben.",
            "dimensions": "{attribute} hat ungültige Bildabmessungen.",
            "distinct": "{attribute} beinhaltet einen bereits vorhandenen Wert.",
            "email": "{attribute} muss eine gültige E-Mail-Adresse sein.",
            "exists": "Der gewählte Wert für {attribute} ist ungültig.",
            "file": "{attribute} muss eine Datei sein.",
            "filled": "{attribute} muss ausgefüllt sein.",
            "gt": {
                "numeric": "{attribute} muss mindestens {value} sein.",
                "file": "{attribute} muss mindestens {value} Kilobytes groß sein.",
                "string": "{attribute} muss mindestens {value} Zeichen lang sein.",
                "array": "{attribute} muss mindestens {value} Elemente haben."
            },
            "gte": {
                "numeric": "{attribute} muss größer oder gleich {value} sein.",
                "file": "{attribute} muss größer oder gleich {value} Kilobytes sein.",
                "string": "{attribute} muss größer oder gleich {value} Zeichen lang sein.",
                "array": "{attribute} muss größer oder gleich {value} Elemente haben."
            },
            "image": "{attribute} muss ein Bild sein.",
            "in": "Der gewählte Wert für {attribute} ist ungültig.",
            "in_array": "Der gewählte Wert für {attribute} kommt nicht in {other} vor.",
            "integer": "{attribute} muss eine ganze Zahl sein.",
            "ip": "{attribute} muss eine gültige IP-Adresse sein.",
            "ipv4": "{attribute} muss eine gültige IPv4-Adresse sein.",
            "ipv6": "{attribute} muss eine gültige IPv6-Adresse sein.",
            "json": "{attribute} muss ein gültiger JSON-String sein.",
            "lt": {
                "numeric": "{attribute} muss kleiner {value} sein.",
                "file": "{attribute} muss kleiner {value} Kilobytes groß sein.",
                "string": "{attribute} muss kleiner {value} Zeichen lang sein.",
                "array": "{attribute} muss kleiner {value} Elemente haben."
            },
            "lte": {
                "numeric": "{attribute} muss kleiner oder gleich {value} sein.",
                "file": "{attribute} muss kleiner oder gleich {value} Kilobytes sein.",
                "string": "{attribute} muss kleiner oder gleich {value} Zeichen lang sein.",
                "array": "{attribute} muss kleiner oder gleich {value} Elemente haben."
            },
            "max": {
                "numeric": "{attribute} darf maximal {max} sein.",
                "file": "{attribute} darf maximal {max} Kilobytes groß sein.",
                "string": "{attribute} darf maximal {max} Zeichen haben.",
                "array": "{attribute} darf nicht mehr als {max} Elemente haben."
            },
            "mimes": "{attribute} muss den Dateityp {values} haben.",
            "mimetypes": "{attribute} muss den Dateityp {values} haben.",
            "min": {
                "numeric": "{attribute} muss mindestens {min} sein.",
                "file": "{attribute} muss mindestens {min} Kilobytes groß sein.",
                "string": "{attribute} muss mindestens {min} Zeichen lang sein.",
                "array": "{attribute} muss mindestens {min} Elemente haben."
            },
            "not_in": "Der gewählte Wert für {attribute} ist ungültig.",
            "not_regex": "{attribute} hat ein ungültiges Format.",
            "numeric": "{attribute} muss eine Zahl sein.",
            "present": "{attribute} muss vorhanden sein.",
            "regex": "{attribute} Format ist ungültig.",
            "required": "{attribute} muss ausgefüllt sein.",
            "required_if": "{attribute} muss ausgefüllt sein, wenn {other} {value} ist.",
            "required_unless": "{attribute} muss ausgefüllt sein, wenn {other} nicht {values} ist.",
            "required_with": "{attribute} muss angegeben werden, wenn {values} ausgefüllt wurde.",
            "required_with_all": "{attribute} muss angegeben werden, wenn {values} ausgefüllt wurde.",
            "required_without": "{attribute} muss angegeben werden, wenn {values} nicht ausgefüllt wurde.",
            "required_without_all": "{attribute} muss angegeben werden, wenn keines der Felder {values} ausgefüllt wurde.",
            "same": "{attribute} und {other} müssen übereinstimmen.",
            "size": {
                "numeric": "{attribute} muss gleich {size} sein.",
                "file": "{attribute} muss {size} Kilobyte groß sein.",
                "string": "{attribute} muss {size} Zeichen lang sein.",
                "array": "{attribute} muss genau {size} Elemente haben."
            },
            "starts_with": "The {attribute} must start with one of the following: {values}",
            "string": "{attribute} muss ein String sein.",
            "timezone": "{attribute} muss eine gültige Zeitzone sein.",
            "unique": "{attribute} ist schon vergeben.",
            "uploaded": "{attribute} konnte nicht hochgeladen werden.",
            "url": "{attribute} muss eine URL sein.",
            "uuid": "{attribute} muss ein UUID sein.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "Name",
                "username": "Benutzername",
                "email": "E-Mail-Adresse",
                "first_name": "Vorname",
                "last_name": "Nachname",
                "password": "Passwort",
                "password_confirmation": "Passwort-Bestätigung",
                "city": "Stadt",
                "country": "Land",
                "address": "Adresse",
                "phone": "Telefonnummer",
                "mobile": "Handynummer",
                "age": "Alter",
                "sex": "Geschlecht",
                "gender": "Geschlecht",
                "day": "Tag",
                "month": "Monat",
                "year": "Jahr",
                "hour": "Stunde",
                "minute": "Minute",
                "second": "Sekunde",
                "title": "Titel",
                "content": "Inhalt",
                "description": "Beschreibung",
                "excerpt": "Auszug",
                "date": "Datum",
                "time": "Uhrzeit",
                "available": "verfügbar",
                "size": "Größe"
            }
        },
        "general": {
            "dashboard": "Dashboard",
            "total_spent": "Ausgaben Gesamt",
            "most_expensive_tag": "Höchste Ausgaben Label",
            "most_expensive_day": "Höchste Ausgaben Tag",
            "analysis": "Analyse",
            "earnings": "Einnahmen",
            "earning": "Einnahme",
            "spendings": "Ausgaben",
            "spending": "Ausgabe",
            "tags": "Label",
            "tag": "Label",
            "recent": "Zuletzt",
            "avatar": "Avatar",
            "name": "Name",
            "email": "E-mail",
            "verify": "Bestätigen",
            "password": "Passwort",
            "language": "Sprache",
            "theme": "Design",
            "recurrings": "Zyklisch"
        }
    },
    "dk": {
        "models": {
            "tags": "Etiket",
            "tag": "Etiketter",
            "recurrings": "Tilbagevendenden",
            "recurring": "Tilbagevendende",
            "earnings": "Indkomster",
            "earning": "Indkomst",
            "spendings": "Udgifter",
            "spending": "Udgift",
            "imports": "Imports",
            "import": "Import"
        },
        "actions": {
            "cancel": "Annullere",
            "create": "Opret",
            "edit": "Redigere",
            "save": "Gemme",
            "delete": "Slet",
            "verify": "Efterprøve",
            "yes": "Ja",
            "no": "Nej"
        },
        "fields": {
            "name": "Navn",
            "avatar": "Avatar",
            "email": "E-mail",
            "password": "Adgangskode",
            "language": "Sprog",
            "theme": "Tema",
            "currency": "Valuta",
            "weekly_report": "Ugentlig Rapport",
            "date": "Dato",
            "description": "Beskrivelse",
            "amount": "Beløb",
            "file": "Fil"
        },
        "calendar": {
            "months": {
                "1": "Januar",
                "2": "Februar",
                "3": "Marts",
                "4": "April",
                "5": "Maj",
                "6": "Juni",
                "7": "Juli",
                "8": "August",
                "9": "September",
                "10": "Oktober",
                "11": "November",
                "12": "December"
            },
            "weekdays": [
                "Mandag",
                "Tirsdag",
                "Onsdag",
                "Torsdag",
                "Fredag",
                "Lørdag",
                "Søndag"
            ]
        },
        "validation": {
            "accepted": "{attribute} skal accepteres.",
            "active_url": "{attribute} er ikke en gyldig URL.",
            "after": "{attribute} skal være en dato efter {date}.",
            "after_or_equal": "{attribute} skal være en dato efter eller lig med {date}.",
            "alpha": "{attribute} må kun bestå af bogstaver.",
            "alpha_dash": "{attribute} må kun bestå af bogstaver, tal og bindestreger.",
            "alpha_num": "{attribute} må kun bestå af bogstaver og tal.",
            "array": "{attribute} skal være et array.",
            "before": "{attribute} skal være en dato før {date}.",
            "before_or_equal": "{attribute} skal være en dato før eller lig med {date}.",
            "between": {
                "numeric": "{attribute} skal være mellem {min} og {max}.",
                "file": "{attribute} skal være mellem {min} og {max} kilobytes.",
                "string": "{attribute} skal være mellem {min} og {max} tegn.",
                "array": "{attribute} skal indeholde mellem {min} og {max} elementer."
            },
            "boolean": "{attribute} skal være sand eller falsk.",
            "confirmed": "{attribute} er ikke det samme som bekræftelsesfeltet.",
            "date": "{attribute} er ikke en gyldig dato.",
            "date_equals": "{attribute} skal være en dato lig med {date}.",
            "date_format": "{attribute} matcher ikke formatet {format}.",
            "different": "{attribute} og {other} skal være forskellige.",
            "digits": "{attribute} skal have {digits} cifre.",
            "digits_between": "{attribute} skal have mellem {min} og {max} cifre.",
            "dimensions": "{attribute} har forkerte billeddimensioner.",
            "distinct": "{attribute} har en duplikatværdi.",
            "email": "{attribute} skal være en gyldig e-mailadresse.",
            "exists": "Valgte {attribute} er ugyldig.",
            "file": "{attribute} skal være en fil.",
            "filled": "{attribute} skal udfyldes.",
            "gt": {
                "numeric": "{attribute} skal være større end {value}.",
                "file": "{attribute} skal være større end {value} kilobytes.",
                "string": "{attribute} skal være mere end {value} tegn.",
                "array": "{attribute} skal være mere end {value} elementer."
            },
            "gte": {
                "numeric": "{attribute} skal være større end eller lig med {value}.",
                "file": "{attribute} skal være større end eller lig med {value} kilobytes.",
                "string": "{attribute} skal være mere end eller lig med {value} tegn.",
                "array": "{attribute} skal have {value} elementer eller mere."
            },
            "image": "{attribute} skal være et billede.",
            "in": "Valgte {attribute} er ugyldig.",
            "in_array": "{attribute} eksisterer ikke i {other}.",
            "integer": "{attribute} skal være et heltal.",
            "ip": "{attribute} skal være en gyldig IP adresse.",
            "ipv4": "{attribute} skal være en gyldig IPv4 adresse.",
            "ipv6": "{attribute} skal være en gyldig IPv6 adresse.",
            "json": "{attribute} skal være en gyldig JSON streng.",
            "lt": {
                "numeric": "{attribute} skal være mindre end {value}.",
                "file": "{attribute} skal være mindre end {value} kilobytes.",
                "string": "{attribute} skal være mindre end {value} tegn.",
                "array": "{attribute} skal have mindre end {value} items."
            },
            "lte": {
                "numeric": "{attribute} skal være mindre eller lig med {value}.",
                "file": "{attribute} skal være mindre eller lig med {value} kilobytes.",
                "string": "{attribute} skal være mindre eller lig med {value} tegn.",
                "array": "{attribute} må ikke have mere end {value} elementer."
            },
            "max": {
                "numeric": "{attribute} må ikke være større end {max}.",
                "file": "{attribute} må ikke være større end {max} kilobytes.",
                "string": "{attribute} må ikke være mere end {max} tegn.",
                "array": "{attribute} må ikke indeholde mere end {max} elementer."
            },
            "mimes": "{attribute} skal være en fil af typen: {values}.",
            "mimetypes": "{attribute} skal være en fil af typen: {values}.",
            "min": {
                "numeric": "{attribute} skal være mindst {min}.",
                "file": "{attribute} skal være mindst {min} kilobytes.",
                "string": "{attribute} skal være mindst {min} tegn.",
                "array": "{attribute} skal indeholde mindst {min} elementer."
            },
            "not_in": "Valgte {attribute} er ugyldig.",
            "not_regex": "Formatet for {attribute} er ugyldigt.",
            "numeric": "{attribute} skal være et tal.",
            "present": "{attribute} skal være tilstede.",
            "regex": "{attribute} formatet er ugyldigt.",
            "required": "{attribute} skal udfyldes.",
            "required_if": "{attribute} skal udfyldes når {other} er {value}.",
            "required_unless": "{attribute} er påkrævet med mindre {other} findes i {values}.",
            "required_with": "{attribute} skal udfyldes når {values} er udfyldt.",
            "required_with_all": "{attribute} skal udfyldes når {values} er udfyldt.",
            "required_without": "{attribute} skal udfyldes når {values} ikke er udfyldt.",
            "required_without_all": "{attribute} skal udfyldes når ingen af {values} er udfyldt.",
            "same": "{attribute} og {other} skal være ens.",
            "size": {
                "numeric": "{attribute} skal være {size}.",
                "file": "{attribute} skal være {size} kilobytes.",
                "string": "{attribute} skal være {size} tegn lang.",
                "array": "{attribute} skal indeholde {size} elementer."
            },
            "starts_with": "{attribute} skal starte med én af følgende: {values}.",
            "string": "{attribute} skal være en streng.",
            "timezone": "{attribute} skal være en gyldig tidszone.",
            "unique": "{attribute} er allerede taget.",
            "uploaded": "{attribute} fejlede i upload.",
            "url": "{attribute} formatet er ugyldigt.",
            "uuid": "{attribute} skal være en gyldig UUID.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "general": {
            "dashboard": "Dashboard",
            "total_earned": "Samlet SOMETHING",
            "total_spent": "Samlet Beløb For Udgifter",
            "most_expensive_tag": "Dyreste Etiket",
            "most_expensive_day": "Dyreste Dag",
            "analysis": "Analyse",
            "recent": "Seneste",
            "profile": "Profil",
            "account": "Account",
            "preferences": "Præferencer",
            "empty_state": "Der er endnu ingen {resource}"
        },
        "pages": {
            "settings": "Indstillinger",
            "log_out": "Log Ud"
        }
    },
    "en": {
        "errors": {
            "oh_no": "Oh no!",
            "unauthorized": "Unauthorized",
            "unauthorized_msg": "Sorry, you are not authorized to access this page",
            "forbidden": "Forbidden",
            "page_not_found": "Page Not Found",
            "page_not_found_msg": "Sorry, the page you are looking for could not be found",
            "page_expired": "Page Expired",
            "page_expired_msg": "Sorry, the page has expired. Please refresh and try again",
            "too_many_requests": "Too Many Requests",
            "too_many_requests_msg": "Sorry, you are making too many requests to our servers",
            "server_side_error": "Error",
            "server_side_error_msg": "Whoops, something went wrong on our servers",
            "service_unavailable": "Service Unavailable",
            "service_unavailable_msg": "Sorry, we are doing some maintenance. Please check back soon"
        },
        "models": {
            "activities": "Activities",
            "activity": "Activity",
            "currencies": "Currencies",
            "currency": "Currency",
            "earnings": "Earnings",
            "earning": "Earning",
            "ideas": "Ideas",
            "idea": "Idea",
            "imports": "Imports",
            "import": "Import",
            "recurrings": "Recurrings",
            "recurring": "Recurring",
            "spaces": "Spaces",
            "space": "Space",
            "spendings": "Spendings",
            "spending": "Spending",
            "tags": "Tags",
            "tag": "Tag",
            "transactions": "Transactions",
            "transaction": "Transaction",
            "most_expensive_tags": "Most Expensive Tags",
            "most_expensive_tag": "Most Expensive Tag"
        },
        "auth": {
            "login": "Login",
            "reset_password": "Reset Password",
            "register": "Register",
            "verify_password": "Verify Password",
            "forgot_password": "Forgot your password?",
            "new_to_budget": "New to Budget?",
            "already_on_budget": "Already on Budget?"
        },
        "actions": {
            "cancel": "Cancel",
            "create": "Create",
            "edit": "Edit",
            "save": "Save",
            "delete": "Delete",
            "submit": "Submit",
            "reset": "Reset",
            "verify": "Verify",
            "select": "Select",
            "search": "Search",
            "filter_by": "Filter by",
            "yes": "Yes",
            "no": "No",
            "previous": "« Previous",
            "next": "Next »",
            "prepare": "Prepare",
            "complete": "Complete"
        },
        "fields": {
            "name": "Name",
            "avatar": "Avatar",
            "email": "E-mail",
            "password": "Password",
            "language": "Language",
            "theme": "Theme",
            "currency": "Currency",
            "weekly_report": "Weekly Report",
            "date": "Date",
            "date_format": "Date Format",
            "description": "Description",
            "amount": "Amount",
            "file": "File",
            "color": "Color",
            "type": "Type",
            "bug_or_error": "Bug or Error",
            "feature_request_or_suggestion": "Feature Request or Suggestion",
            "body": "Body",
            "status": "Status",
            "completed": "Completed",
            "day": "Day",
            "end": "End",
            "active": "Active",
            "inactive": "Inactive"
        },
        "reports": {
            "weekly_balance": {
                "title": "Weekly Balance",
                "description": "Weekly balance per year — displayed in a graph.",
                "graph_title": "Weekly balance per week distributed per month."
            },
            "most_expensive_tags": {
                "title": "Most Expensive Tags",
                "description": "All-time most expensive tags — find out what costs the most."
            }
        },
        "activities": {
            "job_server": "Job server",
            "transaction": {
                "created": "Created Transaction",
                "deleted": "Deleted Transaction"
            },
            "recurring": {
                "created": "Created Recurring",
                "deleted": "Deleted Recurring"
            },
            "tag": {
                "created": "Created Tag",
                "deleted": "Deleted Tag"
            },
            "import": {
                "created": "Created Import",
                "deleted": "Deleted Import"
            },
            "job": "Job"
        },
        "calendar": {
            "months": {
                "1": "January",
                "2": "February",
                "3": "March",
                "4": "April",
                "5": "May",
                "6": "June",
                "7": "July",
                "8": "August",
                "9": "September",
                "10": "October",
                "11": "November",
                "12": "December"
            },
            "weekdays": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ]
        },
        "validation": {
            "accepted": "The {attribute} must be accepted.",
            "active_url": "The {attribute} is not a valid URL.",
            "after": "The {attribute} must be a date after {date}.",
            "after_or_equal": "The {attribute} must be a date after or equal to {date}.",
            "alpha": "The {attribute} may only contain letters.",
            "alpha_dash": "The {attribute} may only contain letters, numbers, dashes and underscores.",
            "alpha_num": "The {attribute} may only contain letters and numbers.",
            "array": "The {attribute} must be an array.",
            "before": "The {attribute} must be a date before {date}.",
            "before_or_equal": "The {attribute} must be a date before or equal to {date}.",
            "between": {
                "numeric": "The {attribute} must be between {min} and {max}.",
                "file": "The {attribute} must be between {min} and {max} kilobytes.",
                "string": "The {attribute} must be between {min} and {max} characters.",
                "array": "The {attribute} must have between {min} and {max} items."
            },
            "boolean": "The {attribute} field must be true or false.",
            "confirmed": "The {attribute} confirmation does not match.",
            "date": "The {attribute} is not a valid date.",
            "date_equals": "The {attribute} must be a date equal to {date}.",
            "date_format": "The {attribute} does not match the format {format}.",
            "different": "The {attribute} and {other} must be different.",
            "digits": "The {attribute} must be {digits} digits.",
            "digits_between": "The {attribute} must be between {min} and {max} digits.",
            "dimensions": "The {attribute} has invalid image dimensions.",
            "distinct": "The {attribute} field has a duplicate value.",
            "email": "The {attribute} must be a valid email address.",
            "ends_with": "The {attribute} must end with one of the following: {values}",
            "exists": "The selected {attribute} is invalid.",
            "file": "The {attribute} must be a file.",
            "filled": "The {attribute} field must have a value.",
            "gt": {
                "numeric": "The {attribute} must be greater than {value}.",
                "file": "The {attribute} must be greater than {value} kilobytes.",
                "string": "The {attribute} must be greater than {value} characters.",
                "array": "The {attribute} must have more than {value} items."
            },
            "gte": {
                "numeric": "The {attribute} must be greater than or equal {value}.",
                "file": "The {attribute} must be greater than or equal {value} kilobytes.",
                "string": "The {attribute} must be greater than or equal {value} characters.",
                "array": "The {attribute} must have {value} items or more."
            },
            "image": "The {attribute} must be an image.",
            "in": "The selected {attribute} is invalid.",
            "in_array": "The {attribute} field does not exist in {other}.",
            "integer": "The {attribute} must be an integer.",
            "ip": "The {attribute} must be a valid IP address.",
            "ipv4": "The {attribute} must be a valid IPv4 address.",
            "ipv6": "The {attribute} must be a valid IPv6 address.",
            "json": "The {attribute} must be a valid JSON string.",
            "lt": {
                "numeric": "The {attribute} must be less than {value}.",
                "file": "The {attribute} must be less than {value} kilobytes.",
                "string": "The {attribute} must be less than {value} characters.",
                "array": "The {attribute} must have less than {value} items."
            },
            "lte": {
                "numeric": "The {attribute} must be less than or equal {value}.",
                "file": "The {attribute} must be less than or equal {value} kilobytes.",
                "string": "The {attribute} must be less than or equal {value} characters.",
                "array": "The {attribute} must not have more than {value} items."
            },
            "max": {
                "numeric": "The {attribute} may not be greater than {max}.",
                "file": "The {attribute} may not be greater than {max} kilobytes.",
                "string": "The {attribute} may not be greater than {max} characters.",
                "array": "The {attribute} may not have more than {max} items."
            },
            "mimes": "The {attribute} must be a file of type: {values}.",
            "mimetypes": "The {attribute} must be a file of type: {values}.",
            "min": {
                "numeric": "The {attribute} must be at least {min}.",
                "file": "The {attribute} must be at least {min} kilobytes.",
                "string": "The {attribute} must be at least {min} characters.",
                "array": "The {attribute} must have at least {min} items."
            },
            "not_in": "The selected {attribute} is invalid.",
            "not_regex": "The {attribute} format is invalid.",
            "numeric": "The {attribute} must be a number.",
            "present": "The {attribute} field must be present.",
            "regex": "The {attribute} format is invalid.",
            "required": "The {attribute} field is required.",
            "required_if": "The {attribute} field is required when {other} is {value}.",
            "required_unless": "The {attribute} field is required unless {other} is in {values}.",
            "required_with": "The {attribute} field is required when {values} is present.",
            "required_with_all": "The {attribute} field is required when {values} are present.",
            "required_without": "The {attribute} field is required when {values} is not present.",
            "required_without_all": "The {attribute} field is required when none of {values} are present.",
            "same": "The {attribute} and {other} must match.",
            "size": {
                "numeric": "The {attribute} must be {size}.",
                "file": "The {attribute} must be {size} kilobytes.",
                "string": "The {attribute} must be {size} characters.",
                "array": "The {attribute} must contain {size} items."
            },
            "starts_with": "The {attribute} must start with one of the following: {values}",
            "string": "The {attribute} must be a string.",
            "timezone": "The {attribute} must be a valid zone.",
            "unique": "The {attribute} has already been taken.",
            "uploaded": "The {attribute} failed to upload.",
            "url": "The {attribute} format is invalid.",
            "uuid": "The {attribute} must be a valid UUID.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "emails": {
            "why_recieving_this_mail": "You're receiving this email because you have a Budget account.",
            "account": "Account",
            "contact_us": "Contact Us",
            "default_title": "Hey There!",
            "password_changed": {
                "message": "Heads up! Your password has been changed",
                "button": "Login"
            },
            "verify_registration": {
                "welcome_message": "Welcome aboard",
                "message": "We're going to help you get insight into your personal finances.<br/>No more dealing with pesky, half-assed spreadsheets.",
                "button": "Verify Registration"
            },
            "reset_password": {
                "message": "It looks like someone submitted a request to reset your Budget password. If it wasn’t you there's nothing to do nor worry about. You can keep on keeping on.<br/>If this was you, click the button below to reset your password and get back into your account.",
                "button": "Change Password"
            },
            "weekly_report": {
                "title": "Here's your weekly report for",
                "message": "Here's your weekly report for",
                "this_week": "This week",
                "you_have": "you've",
                "spent": "Spent",
                "most_spent": "Most of which you've spent on",
                "tired_of_reports": "Tired of these reports?",
                "button": "Change Preferences"
            }
        },
        "general": {
            "all": "All",
            "dashboard": "Dashboard",
            "balance": "Balance",
            "daily_balance": "Daily Balance",
            "left_to_spend": "Left to Spend",
            "total_earned": "Total Earned",
            "total_spent": "Total Spent",
            "most_expensive_tag": "Most Expensive Tag",
            "most_expensive_day": "Most Expensive Day",
            "days_ago": "days ago",
            "analysis": "Analysis",
            "recent": "Recent",
            "profile": "Profile",
            "account": "Account",
            "preferences": "Preferences",
            "empty_state": "There aren't any {resource} yet",
            "verify_account": "You still need to verify your account&mdash;please check your e-mail",
            "resend_verify_registration": "Resend the verification email",
            "spaces_explanation": "Spaces can be used to separate your finances in Budget. For example—you can have a space for your personal finances and another space for your business' finances.",
            "know_how_to_make_this_app_better": "Know how to make this app better",
            "themes": {
                "light": "Light",
                "dark": "Dark (Experimental)"
            },
            "time": {
                "second": "seconds|seconds",
                "minute": "minute|minutes",
                "hour": "hour|hours",
                "day": "day|days",
                "month": "month|months",
                "year": "year|years",
                "today": "today",
                "ahead": "ahead",
                "ago": "ago"
            }
        },
        "messages": {
            "empty_state": "There aren't any {resource} (yet)",
            "email_sent": "If you registered with that address, we've sent you an e-mail",
            "password_changed": "Your password has been changed",
            "login_failed": {
                "simple": "Failed to login",
                "verify_account": "You still need to verify your account<br/>Please check your e-mail or",
                "wrong_password": "The password you entered is incorrect"
            },
            "created_account": "You've successfully created your account<br/>Please check your e-mail to verify your account",
            "no_account_found": "We couldn't find a account for your email",
            "resent_email": "We've successfully sent a new email<br/>Please check your e-mail to verify your account",
            "verified_account": "You've successfully verified your account",
            "already_verified": "Your account is already verified",
            "resend_verify_registration": "resend the verification email",
            "logged_out": "You've been successfully logged out",
            "spaces_explanation": "Spaces can be used to separate your finances in Budget. For example — you can have a space for your personal finances and another space for your business' finances.",
            "know_how_to_make_this_app_better": "Know how to make this app better?",
            "successfully_deleted": "You've successfully deleted that {resource}",
            "still_able_to_recover": "You can still recover it",
            "transaction_wizard": {
                "new_earning_description": "Paycheck February",
                "new_spending_description": "Birthday Present for Angela",
                "recurring_explanation": "This is a recurring transaction",
                "recurring_duration": "How long will this transaction go on for?",
                "forever": "Forever",
                "until": "Until",
                "loading": "Loading",
                "successfully_created": "You've successfully created that transaction"
            }
        },
        "pages": {
            "settings": "Settings",
            "log_out": "Log Out",
            "reports": "Reports"
        }
    },
    "fr": {
        "actions": {
            "cancel": "Annuler",
            "create": "Créer",
            "edit": "Modifier",
            "save": "Sauvegarder",
            "delete": "Supprimer",
            "verify": "Vérifier",
            "yes": "Oui",
            "no": "Non"
        },
        "fields": {
            "name": "Nom",
            "avatar": "Avatar",
            "email": "E-mail",
            "password": "Mot de passe",
            "language": "Langue",
            "theme": "Thème",
            "currency": "Devise",
            "weekly_report": "Rapport Hebdomadaire\n"
        },
        "calendar": {
            "months": {
                "1": "Janvier",
                "2": "Février",
                "3": "Mars",
                "4": "Avril",
                "5": "Mai",
                "6": "Juin",
                "7": "Juillet",
                "8": "Août",
                "9": "Septembre",
                "10": "Octobre",
                "11": "Novembre",
                "12": "Décembre"
            },
            "weekdays": [
                "Lundi",
                "Mardi",
                "Mercredi",
                "Jeudi",
                "Vendredi",
                "Samedi",
                "Dimanche"
            ]
        },
        "validation": {
            "accepted": "Le champ {attribute} doit être accepté.",
            "active_url": "Le champ {attribute} n'est pas une URL valide.",
            "after": "Le champ {attribute} doit être une date postérieure au {date}.",
            "after_or_equal": "Le champ {attribute} doit être une date postérieure ou égale au {date}.",
            "alpha": "Le champ {attribute} doit contenir uniquement des lettres.",
            "alpha_dash": "Le champ {attribute} doit contenir uniquement des lettres, des chiffres et des tirets.",
            "alpha_num": "Le champ {attribute} doit contenir uniquement des chiffres et des lettres.",
            "array": "Le champ {attribute} doit être un tableau.",
            "before": "Le champ {attribute} doit être une date antérieure au {date}.",
            "before_or_equal": "Le champ {attribute} doit être une date antérieure ou égale au {date}.",
            "between": {
                "numeric": "La valeur de {attribute} doit être comprise entre {min} et {max}.",
                "file": "La taille du fichier de {attribute} doit être comprise entre {min} et {max} kilo-octets.",
                "string": "Le texte {attribute} doit contenir entre {min} et {max} caractères.",
                "array": "Le tableau {attribute} doit contenir entre {min} et {max} éléments."
            },
            "boolean": "Le champ {attribute} doit être vrai ou faux.",
            "confirmed": "Le champ de confirmation {attribute} ne correspond pas.",
            "date": "Le champ {attribute} n'est pas une date valide.",
            "date_equals": "Le champ {attribute} doit être une date égale à {date}.",
            "date_format": "Le champ {attribute} ne correspond pas au format {format}.",
            "different": "Les champs {attribute} et {other} doivent être différents.",
            "digits": "Le champ {attribute} doit contenir {digits} chiffres.",
            "digits_between": "Le champ {attribute} doit contenir entre {min} et {max} chiffres.",
            "dimensions": "La taille de l'image {attribute} n'est pas conforme.",
            "distinct": "Le champ {attribute} a une valeur en double.",
            "email": "Le champ {attribute} doit être une adresse email valide.",
            "ends_with": "Le champ {attribute} doit se terminer par une des valeurs suivantes : {values}",
            "exists": "Le champ {attribute} sélectionné est invalide.",
            "file": "Le champ {attribute} doit être un fichier.",
            "filled": "Le champ {attribute} doit avoir une valeur.",
            "gt": {
                "numeric": "La valeur de {attribute} doit être supérieure à {value}.",
                "file": "La taille du fichier de {attribute} doit être supérieure à {value} kilo-octets.",
                "string": "Le texte {attribute} doit contenir plus de {value} caractères.",
                "array": "Le tableau {attribute} doit contenir plus de {value} éléments."
            },
            "gte": {
                "numeric": "La valeur de {attribute} doit être supérieure ou égale à {value}.",
                "file": "La taille du fichier de {attribute} doit être supérieure ou égale à {value} kilo-octets.",
                "string": "Le texte {attribute} doit contenir au moins {value} caractères.",
                "array": "Le tableau {attribute} doit contenir au moins {value} éléments."
            },
            "image": "Le champ {attribute} doit être une image.",
            "in": "Le champ {attribute} est invalide.",
            "in_array": "Le champ {attribute} n'existe pas dans {other}.",
            "integer": "Le champ {attribute} doit être un entier.",
            "ip": "Le champ {attribute} doit être une adresse IP valide.",
            "ipv4": "Le champ {attribute} doit être une adresse IPv4 valide.",
            "ipv6": "Le champ {attribute} doit être une adresse IPv6 valide.",
            "json": "Le champ {attribute} doit être un document JSON valide.",
            "lt": {
                "numeric": "La valeur de {attribute} doit être inférieure à {value}.",
                "file": "La taille du fichier de {attribute} doit être inférieure à {value} kilo-octets.",
                "string": "Le texte {attribute} doit contenir moins de {value} caractères.",
                "array": "Le tableau {attribute} doit contenir moins de {value} éléments."
            },
            "lte": {
                "numeric": "La valeur de {attribute} doit être inférieure ou égale à {value}.",
                "file": "La taille du fichier de {attribute} doit être inférieure ou égale à {value} kilo-octets.",
                "string": "Le texte {attribute} doit contenir au plus {value} caractères.",
                "array": "Le tableau {attribute} doit contenir au plus {value} éléments."
            },
            "max": {
                "numeric": "La valeur de {attribute} ne peut être supérieure à {max}.",
                "file": "La taille du fichier de {attribute} ne peut pas dépasser {max} kilo-octets.",
                "string": "Le texte de {attribute} ne peut contenir plus de {max} caractères.",
                "array": "Le tableau {attribute} ne peut contenir plus de {max} éléments."
            },
            "mimes": "Le champ {attribute} doit être un fichier de type : {values}.",
            "mimetypes": "Le champ {attribute} doit être un fichier de type : {values}.",
            "min": {
                "numeric": "La valeur de {attribute} doit être supérieure ou égale à {min}.",
                "file": "La taille du fichier de {attribute} doit être supérieure à {min} kilo-octets.",
                "string": "Le texte {attribute} doit contenir au moins {min} caractères.",
                "array": "Le tableau {attribute} doit contenir au moins {min} éléments."
            },
            "not_in": "Le champ {attribute} sélectionné n'est pas valide.",
            "not_regex": "Le format du champ {attribute} n'est pas valide.",
            "numeric": "Le champ {attribute} doit contenir un nombre.",
            "present": "Le champ {attribute} doit être présent.",
            "regex": "Le format du champ {attribute} est invalide.",
            "required": "Le champ {attribute} est obligatoire.",
            "required_if": "Le champ {attribute} est obligatoire quand la valeur de {other} est {value}.",
            "required_unless": "Le champ {attribute} est obligatoire sauf si {other} est {values}.",
            "required_with": "Le champ {attribute} est obligatoire quand {values} est présent.",
            "required_with_all": "Le champ {attribute} est obligatoire quand {values} sont présents.",
            "required_without": "Le champ {attribute} est obligatoire quand {values} n'est pas présent.",
            "required_without_all": "Le champ {attribute} est requis quand aucun de {values} n'est présent.",
            "same": "Les champs {attribute} et {other} doivent être identiques.",
            "size": {
                "numeric": "La valeur de {attribute} doit être {size}.",
                "file": "La taille du fichier de {attribute} doit être de {size} kilo-octets.",
                "string": "Le texte de {attribute} doit contenir {size} caractères.",
                "array": "Le tableau {attribute} doit contenir {size} éléments."
            },
            "starts_with": "Le champ {attribute} doit commencer avec une des valeurs suivantes : {values}",
            "string": "Le champ {attribute} doit être une chaîne de caractères.",
            "timezone": "Le champ {attribute} doit être un fuseau horaire valide.",
            "unique": "La valeur du champ {attribute} est déjà utilisée.",
            "uploaded": "Le fichier du champ {attribute} n'a pu être téléversé.",
            "url": "Le format de l'URL de {attribute} n'est pas valide.",
            "uuid": "Le champ {attribute} doit être un UUID valide",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "nom",
                "username": "nom d'utilisateur",
                "email": "adresse email",
                "first_name": "prénom",
                "last_name": "nom",
                "password": "mot de passe",
                "password_confirmation": "confirmation du mot de passe",
                "city": "ville",
                "country": "pays",
                "address": "adresse",
                "phone": "téléphone",
                "mobile": "portable",
                "age": "âge",
                "sex": "sexe",
                "gender": "genre",
                "day": "jour",
                "month": "mois",
                "year": "année",
                "hour": "heure",
                "minute": "minute",
                "second": "seconde",
                "title": "titre",
                "content": "contenu",
                "description": "description",
                "excerpt": "extrait",
                "date": "date",
                "time": "heure",
                "available": "disponible",
                "size": "taille"
            }
        },
        "general": {
            "dashboard": "Tableau de bord",
            "total_earned": "Total Gagné",
            "total_spent": "Total Dépensé",
            "most_expensive_tag": "Tag \"le plus cher\" ",
            "most_expensive_day": "Jour \"le plus cher\"",
            "analysis": "Analyse",
            "earnings": "Gains",
            "earning": "Gain",
            "spendings": "Depenses",
            "spending": "Depense",
            "tags": "Etiquettes",
            "tag": "Etiquette",
            "recent": "Récent",
            "recurrings": "Récurrences",
            "recurring": "Récurrent",
            "profile": "Profil",
            "account": "Compte",
            "preferences": "Préférences",
            "empty_state": "Il n'y  a pas encore de {resource}"
        },
        "pages": {
            "settings": "Options",
            "log_out": "Déconnexion"
        }
    },
    "nl": {
        "models": {
            "activities": "Activiteiten",
            "activity": "Activiteit",
            "currencies": "Valuta's",
            "currency": "Valuta",
            "earnings": "Inkomsten",
            "earning": "Inkomst",
            "ideas": "Ideeën",
            "idea": "Idee",
            "imports": "Imports",
            "import": "Import",
            "recurrings": "Doorlopenden",
            "recurring": "Doorlopende",
            "spaces": "Spaces",
            "space": "Space",
            "spendings": "Uitgaven",
            "spending": "Uitgave",
            "tags": "Categorieën",
            "tag": "Categorie",
            "transactions": "Transacties",
            "transaction": "Transactie"
        },
        "auth": {
            "login": "Login",
            "reset_password": "Wachtwoord Resetten",
            "register": "Registereren",
            "verify_password": "Herhaal Wachtwoord",
            "forgot_password": "Je wachtwoord vergeten?",
            "new_to_budget": "Nieuw bij Budget?",
            "already_on_budget": "Al aangemeld bij Budget?"
        },
        "actions": {
            "cancel": "Annuleer",
            "create": "Creëer",
            "edit": "Bewerk",
            "save": "Opslaan",
            "delete": "Verwijderen",
            "submit": "Verstuur",
            "reset": "Reset",
            "verify": "Controleer",
            "select": "Selecteer",
            "search": "Zoeken",
            "filter_by": "Filteren op",
            "yes": "Ja",
            "no": "Nee",
            "previous": "« Vorige",
            "next": "Volgende »",
            "prepare": "Voorbereiden",
            "complete": "Voltooien"
        },
        "fields": {
            "name": "Naam",
            "avatar": "Avatar",
            "email": "E-mail",
            "password": "Wachtwoord",
            "language": "Taal",
            "theme": "Thema",
            "currency": "Valuta",
            "weekly_report": "Wekelijks Verslag",
            "date": "Datum",
            "date_format": "Datum Formaat",
            "description": "Omschrijving",
            "amount": "Bedrag",
            "file": "Bestand",
            "color": "Kleur",
            "type": "Type",
            "bug_or_error": "Bug of Fout",
            "feature_request_or_suggestion": "Feature Request or Suggestie",
            "body": "Inhoud",
            "status": "Status",
            "completed": "Voltooid",
            "day": "Dag",
            "end": "Eind",
            "active": "Actief",
            "inactive": "Inactief"
        },
        "reports": {
            "weekly_balance": {
                "title": "Saldo per Week",
                "description": "Wekelijks saldo per jaar — weergegeven in een grafiek.",
                "graph_title": "Wekelijks saldo per week gedistribueerd per maand."
            },
            "most_expensive_tags": {
                "title": "Duurste Categorieën",
                "description": "De duurste categorieën — kom erachter wat het meest kost."
            }
        },
        "activities": {
            "transaction": {
                "created": "Transactie Aangemaakt",
                "deleted": "Transactie Verwijderd"
            },
            "recurring": {
                "created": "Doorlopende Aangemaakt",
                "deleted": "Doorlopende Verwijderd"
            },
            "tag": {
                "created": "Categorie Aangemaakt",
                "deleted": "Categorie Verwijderd"
            },
            "import": {
                "created": "Import Aangemaakt",
                "deleted": "Import Verwijderd"
            }
        },
        "calendar": {
            "months": {
                "1": "Januari",
                "2": "Februari",
                "3": "Maart",
                "4": "April",
                "5": "Mei",
                "6": "Juni",
                "7": "Juli",
                "8": "Augustus",
                "9": "September",
                "10": "Oktober",
                "11": "November",
                "12": "December"
            },
            "weekdays": [
                "Maandag",
                "Dinsdag",
                "Woensdag",
                "Donderdag",
                "Vrijdag",
                "Zaterdag",
                "Zondag"
            ]
        },
        "validation": {
            "accepted": "{attribute} moet geaccepteerd zijn.",
            "active_url": "{attribute} is geen geldige URL.",
            "after": "{attribute} moet een datum na {date} zijn.",
            "after_or_equal": "{attribute} moet een datum na of gelijk aan {date} zijn.",
            "alpha": "{attribute} mag alleen letters bevatten.",
            "alpha_dash": "{attribute} mag alleen letters, nummers, underscores (_) en streepjes (-) bevatten.",
            "alpha_num": "{attribute} mag alleen letters en nummers bevatten.",
            "array": "{attribute} moet geselecteerde elementen bevatten.",
            "before": "{attribute} moet een datum voor {date} zijn.",
            "before_or_equal": "{attribute} moet een datum voor of gelijk aan {date} zijn.",
            "between": {
                "numeric": "{attribute} moet tussen {min} en {max} zijn.",
                "file": "{attribute} moet tussen {min} en {max} kilobytes zijn.",
                "string": "{attribute} moet tussen {min} en {max} karakters zijn.",
                "array": "{attribute} moet tussen {min} en {max} items bevatten."
            },
            "boolean": "{attribute} moet ja of nee zijn.",
            "confirmed": "{attribute} bevestiging komt niet overeen.",
            "date": "{attribute} moet een datum bevatten.",
            "date_equals": "{attribute} moet een datum gelijk aan {date} zijn.",
            "date_format": "{attribute} moet een geldig datum formaat bevatten.",
            "different": "{attribute} en {other} moeten verschillend zijn.",
            "digits": "{attribute} moet bestaan uit {digits} cijfers.",
            "digits_between": "{attribute} moet bestaan uit minimaal {min} en maximaal {max} cijfers.",
            "dimensions": "{attribute} heeft geen geldige afmetingen voor afbeeldingen.",
            "distinct": "{attribute} heeft een dubbele waarde.",
            "email": "{attribute} is geen geldig e-mailadres.",
            "exists": "{attribute} bestaat niet.",
            "file": "{attribute} moet een bestand zijn.",
            "filled": "{attribute} is verplicht.",
            "gt": {
                "numeric": "De {attribute} moet groter zijn dan {value}.",
                "file": "De {attribute} moet groter zijn dan {value} kilobytes.",
                "string": "De {attribute} moet meer dan {value} tekens bevatten.",
                "array": "De {attribute} moet meer dan {value} waardes bevatten."
            },
            "gte": {
                "numeric": "De {attribute} moet groter of gelijk zijn aan {value}.",
                "file": "De {attribute} moet groter of gelijk zijn aan {value} kilobytes.",
                "string": "De {attribute} moet minimaal {value} tekens bevatten.",
                "array": "De {attribute} moet {value} waardes of meer bevatten."
            },
            "image": "{attribute} moet een afbeelding zijn.",
            "in": "{attribute} is ongeldig.",
            "in_array": "{attribute} bestaat niet in {other}.",
            "integer": "{attribute} moet een getal zijn.",
            "ip": "{attribute} moet een geldig IP-adres zijn.",
            "ipv4": "{attribute} moet een geldig IPv4-adres zijn.",
            "ipv6": "{attribute} moet een geldig IPv6-adres zijn.",
            "json": "{attribute} moet een geldige JSON-string zijn.",
            "lt": {
                "numeric": "De {attribute} moet kleiner zijn dan {value}.",
                "file": "De {attribute} moet kleiner zijn dan {value} kilobytes.",
                "string": "De {attribute} moet minder dan {value} tekens bevatten.",
                "array": "De {attribute} moet minder dan {value} waardes bevatten."
            },
            "lte": {
                "numeric": "De {attribute} moet kleiner of gelijk zijn aan {value}.",
                "file": "De {attribute} moet kleiner of gelijk zijn aan {value} kilobytes.",
                "string": "De {attribute} moet maximaal {value} tekens bevatten.",
                "array": "De {attribute} moet {value} waardes of minder bevatten."
            },
            "max": {
                "numeric": "{attribute} mag niet hoger dan {max} zijn.",
                "file": "{attribute} mag niet meer dan {max} kilobytes zijn.",
                "string": "{attribute} mag niet uit meer dan {max} tekens bestaan.",
                "array": "{attribute} mag niet meer dan {max} items bevatten."
            },
            "mimes": "{attribute} moet een bestand zijn van het bestandstype {values}.",
            "mimetypes": "{attribute} moet een bestand zijn van het bestandstype {values}.",
            "min": {
                "numeric": "{attribute} moet minimaal {min} zijn.",
                "file": "{attribute} moet minimaal {min} kilobytes zijn.",
                "string": "{attribute} moet minimaal {min} tekens zijn.",
                "array": "{attribute} moet minimaal {min} items bevatten."
            },
            "not_in": "Het formaat van {attribute} is ongeldig.",
            "not_regex": "De {attribute} formaat is ongeldig.",
            "numeric": "{attribute} moet een nummer zijn.",
            "present": "{attribute} moet bestaan.",
            "regex": "{attribute} formaat is ongeldig.",
            "required": "{attribute} is verplicht.",
            "required_if": "{attribute} is verplicht indien {other} gelijk is aan {value}.",
            "required_unless": "{attribute} is verplicht tenzij {other} gelijk is aan {values}.",
            "required_with": "{attribute} is verplicht i.c.m. {values}",
            "required_with_all": "{attribute} is verplicht i.c.m. {values}",
            "required_without": "{attribute} is verplicht als {values} niet ingevuld is.",
            "required_without_all": "{attribute} is verplicht als {values} niet ingevuld zijn.",
            "same": "{attribute} en {other} moeten overeenkomen.",
            "size": {
                "numeric": "{attribute} moet {size} zijn.",
                "file": "{attribute} moet {size} kilobyte zijn.",
                "string": "{attribute} moet {size} tekens zijn.",
                "array": "{attribute} moet {size} items bevatten."
            },
            "starts_with": "{attribute} moet starten met een van de volgende: {values}",
            "string": "{attribute} moet een tekst zijn.",
            "timezone": "{attribute} moet een geldige tijdzone zijn.",
            "unique": "{attribute} is al in gebruik.",
            "uploaded": "Het uploaden van {attribute} is mislukt.",
            "url": "{attribute} moet een geldig URL zijn.",
            "uuid": "{attribute} moet een geldig UUID zijn.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "address": "adres",
                "age": "leeftijd",
                "amount": "bedrag",
                "available": "beschikbaar",
                "city": "stad",
                "content": "inhoud",
                "country": "land",
                "currency": "valuta",
                "date": "datum",
                "day": "dag",
                "description": "omschrijving",
                "email": "e-mailadres",
                "excerpt": "uittreksel",
                "first_name": "voornaam",
                "gender": "geslacht",
                "hour": "uur",
                "last_name": "achternaam",
                "message": "boodschap",
                "minute": "minuut",
                "mobile": "mobiel",
                "month": "maand",
                "name": "naam",
                "password": "wachtwoord",
                "password_confirmation": "wachtwoordbevestiging",
                "phone": "telefoonnummer",
                "second": "seconde",
                "sex": "geslacht",
                "size": "grootte",
                "subject": "onderwerp",
                "time": "tijd",
                "title": "titel",
                "username": "gebruikersnaam",
                "year": "jaar"
            }
        },
        "general": {
            "dashboard": "Overzicht",
            "balance": "Saldo",
            "daily_balance": "Dagelijks Saldo",
            "left_to_spend": "Resterend Te Besteden",
            "total_earned": "Totaal Verdiend",
            "total_spent": "Totaal Uitgegeven",
            "most_expensive_tag": "Duurste Categroie",
            "most_expensive_day": "Duurste Dag",
            "days_ago": "dagen geleden",
            "analysis": "Analyse",
            "recent": "Recente",
            "profile": "Profiel",
            "account": "Account",
            "preferences": "Voorkeuren",
            "themes": {
                "light": "Licht",
                "dark": "Donker (Experimenteel)"
            }
        },
        "messages": {
            "empty_state": "Er zijn nog geen {resource}",
            "verify_account": "Je moet je account nog verifiëren — check je e-mail",
            "email_sent": "Als je je met dat adres hebt ingeschreven, hebben we je een e-mail gestuurd",
            "password_changed": "Je wachtwoord is gewijzigd",
            "login_failed": "Inloggen mislukt",
            "verified_account": "Je account is geverifieerd",
            "spaces_explanation": "Spaces kunnen worden gebruikt om je financiën op sorteren in Budget. Bijvoorbeeld — je kan een space hebben voor jou persoonlijk en een andere voor je bedrijf.",
            "know_how_to_make_this_app_better": "Weet je wat er beter kan?",
            "successfully_deleted": "Je hebt succesvol die {resource} verwijderd",
            "still_able_to_recover": "Je kan hem nog herstellen",
            "transaction_wizard": {
                "new_earning_description": "Loonstrook februari",
                "new_spending_description": "Verjaardagscadeau voor Angela",
                "recurring_explanation": "Dit is een doorlopende transactie",
                "recurring_duration": "Hoe lang duurt deze doorlopende transactie?",
                "forever": "Oneindig :(",
                "until": "Tot en met",
                "loading": "Laden",
                "successfully_created": "Je hebt succesvol die transactie aangemaakt"
            }
        },
        "pages": {
            "settings": "Instellingen",
            "log_out": "Log Uit",
            "reports": "Verslagen"
        }
    },
    "pt": {
        "models": {
            "spaces": "Espaços",
            "space": "Espaço",
            "tags": "Etiquetas",
            "tag": "Etiqueta",
            "recurrings": "Recorrências",
            "recurring": "Recorrência",
            "earnings": "Ganhos",
            "earning": "Ganho",
            "spendings": "Gastos",
            "spending": "Gasto",
            "imports": "Importações",
            "import": "Importar"
        },
        "actions": {
            "cancel": "Cancelar",
            "create": "Criar",
            "edit": "Editar",
            "save": "Salvar",
            "delete": "Deletar",
            "verify": "Verificar",
            "yes": "Sim",
            "no": "Não"
        },
        "fields": {
            "name": "Nome",
            "avatar": "Avatar",
            "email": "E-mail",
            "password": "Senha",
            "language": "Idioma",
            "theme": "Tema",
            "currency": "Moeda",
            "weekly_report": "Relatório Semanal",
            "date": "Data",
            "description": "Descrição",
            "amount": "Montante",
            "file": "Ficheiro"
        },
        "calendar": {
            "months": {
                "1": "Janeiro",
                "2": "Fevereiro",
                "3": "Março",
                "4": "Abril",
                "5": "Maio",
                "6": "Junho",
                "7": "Julho",
                "8": "Agosto",
                "9": "Setembro",
                "10": "Outubro",
                "11": "Novembro",
                "12": "Dezembro"
            },
            "weekdays": [
                "Segunda-feira",
                "Terça-feira",
                "Quarta-feira",
                "Quinta-feira",
                "Sexta-feira",
                "Sábado-feira",
                "Domingo-feira"
            ]
        },
        "validation": {
            "accepted": "O campo {attribute} deverá ser aceite.",
            "active_url": "O campo {attribute} não contém um URL válido.",
            "after": "O campo {attribute} deverá conter uma data posterior a {date}.",
            "after_or_equal": "O campo {attribute} deverá conter uma data posterior ou igual a {date}.",
            "alpha": "O campo {attribute} deverá conter apenas letras.",
            "alpha_dash": "O campo {attribute} deverá conter apenas letras, números e traços.",
            "alpha_num": "O campo {attribute} deverá conter apenas letras e números .",
            "array": "O campo {attribute} deverá conter uma coleção de elementos.",
            "before": "O campo {attribute} deverá conter uma data anterior a {date}.",
            "before_or_equal": "O Campo {attribute} deverá conter uma data anterior ou igual a {date}.",
            "between": {
                "numeric": "O campo {attribute} deverá ter um valor entre {min} - {max}.",
                "file": "O campo {attribute} deverá ter um tamanho entre {min} - {max} kilobytes.",
                "string": "O campo {attribute} deverá conter entre {min} - {max} caracteres.",
                "array": "O campo {attribute} deverá conter entre {min} - {max} elementos."
            },
            "boolean": "O campo {attribute} deverá conter o valor verdadeiro ou falso.",
            "confirmed": "A confirmação para o campo {attribute} não coincide.",
            "date": "O campo {attribute} não contém uma data válida.",
            "date_equals": "The {attribute} must be a date equal to {date}.",
            "date_format": "A data indicada para o campo {attribute} não respeita o formato {format}.",
            "different": "Os campos {attribute} e {other} deverão conter valores diferentes.",
            "digits": "O campo {attribute} deverá conter {digits} caracteres.",
            "digits_between": "O campo {attribute} deverá conter entre {min} a {max} caracteres.",
            "dimensions": "O campo {attribute} deverá conter uma dimensão de imagem válida.",
            "distinct": "O campo {attribute} contém um valor duplicado.",
            "email": "O campo {attribute} não contém um endereço de correio eletrónico válido.",
            "exists": "O valor selecionado para o campo {attribute} é inválido.",
            "file": "O campo {attribute} deverá conter um ficheiro.",
            "filled": "É obrigatória a indicação de um valor para o campo {attribute}.",
            "gt": {
                "numeric": "The {attribute} must be greater than {value}.",
                "file": "The {attribute} must be greater than {value} kilobytes.",
                "string": "The {attribute} must be greater than {value} characters.",
                "array": "The {attribute} must have more than {value} items."
            },
            "gte": {
                "numeric": "The {attribute} must be greater than or equal {value}.",
                "file": "The {attribute} must be greater than or equal {value} kilobytes.",
                "string": "The {attribute} must be greater than or equal {value} characters.",
                "array": "The {attribute} must have {value} items or more."
            },
            "image": "O campo {attribute} deverá conter uma imagem.",
            "in": "O campo {attribute} não contém um valor válido.",
            "in_array": "O campo {attribute} não existe em {other}.",
            "integer": "O campo {attribute} deverá conter um número inteiro.",
            "ip": "O campo {attribute} deverá conter um IP válido.",
            "ipv4": "O campo {attribute} deverá conter um IPv4 válido.",
            "ipv6": "O campo {attribute} deverá conter um IPv6 válido.",
            "json": "O campo {attribute} deverá conter um texto JSON válido.",
            "lt": {
                "numeric": "The {attribute} must be less than {value}.",
                "file": "The {attribute} must be less than {value} kilobytes.",
                "string": "The {attribute} must be less than {value} characters.",
                "array": "The {attribute} must have less than {value} items."
            },
            "lte": {
                "numeric": "The {attribute} must be less than or equal {value}.",
                "file": "The {attribute} must be less than or equal {value} kilobytes.",
                "string": "The {attribute} must be less than or equal {value} characters.",
                "array": "The {attribute} must not have more than {value} items."
            },
            "max": {
                "numeric": "O campo {attribute} não deverá conter um valor superior a {max}.",
                "file": "O campo {attribute} não deverá ter um tamanho superior a {max} kilobytes.",
                "string": "O campo {attribute} não deverá conter mais de {max} caracteres.",
                "array": "O campo {attribute} não deverá conter mais de {max} elementos."
            },
            "mimes": "O campo {attribute} deverá conter um ficheiro do tipo: {values}.",
            "mimetypes": "O campo {attribute} deverá conter um ficheiro do tipo: {values}.",
            "min": {
                "numeric": "O campo {attribute} deverá ter um valor superior ou igual a {min}.",
                "file": "O campo {attribute} deverá ter no mínimo {min} kilobytes.",
                "string": "O campo {attribute} deverá conter no mínimo {min} caracteres.",
                "array": "O campo {attribute} deverá conter no mínimo {min} elementos."
            },
            "not_in": "O campo {attribute} contém um valor inválido.",
            "not_regex": "The {attribute} format is invalid.",
            "numeric": "O campo {attribute} deverá conter um valor numérico.",
            "present": "O campo {attribute} deverá estar presente.",
            "regex": "O formato do valor para o campo {attribute} é inválido.",
            "required": "É obrigatória a indicação de um valor para o campo {attribute}.",
            "required_if": "É obrigatória a indicação de um valor para o campo {attribute} quando o valor do campo {other} é igual a {value}.",
            "required_unless": "É obrigatória a indicação de um valor para o campo {attribute} a menos que {other} esteja presente em {values}.",
            "required_with": "É obrigatória a indicação de um valor para o campo {attribute} quando {values} está presente.",
            "required_with_all": "É obrigatória a indicação de um valor para o campo {attribute} quando um dos {values} está presente.",
            "required_without": "É obrigatória a indicação de um valor para o campo {attribute} quando {values} não está presente.",
            "required_without_all": "É obrigatória a indicação de um valor para o campo {attribute} quando nenhum dos {values} está presente.",
            "same": "Os campos {attribute} e {other} deverão conter valores iguais.",
            "size": {
                "numeric": "O campo {attribute} deverá conter o valor {size}.",
                "file": "O campo {attribute} deverá ter o tamanho de {size} kilobytes.",
                "string": "O campo {attribute} deverá conter {size} caracteres.",
                "array": "O campo {attribute} deverá conter {size} elementos."
            },
            "starts_with": "The {attribute} must start with one of the following: {values}",
            "string": "O campo {attribute} deverá conter texto.",
            "timezone": "O campo {attribute} deverá ter um fuso horário válido.",
            "unique": "O valor indicado para o campo {attribute} já se encontra registado.",
            "uploaded": "O upload do ficheiro {attribute} falhou.",
            "url": "O formato do URL indicado para o campo {attribute} é inválido.",
            "uuid": "The {attribute} must be a valid UUID.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "general": {
            "dashboard": "Painel de Controle",
            "balance": "Balanço",
            "recurrings": "Recorrências",
            "left_to_spend": "Para gastar",
            "total_earned": "Total de ganhos",
            "total_spent": "Total de gastos",
            "most_expensive_tag": "Etiqueta Mais Cara",
            "most_expensive_day": "Dia Mais Caro",
            "analysis": "Análises",
            "recent": "Recente",
            "profile": "Perfil",
            "account": "Conta",
            "preferences": "Preferências",
            "empty_state": "Não há qualquer recurso ainda"
        },
        "pages": {
            "settings": "Definições",
            "log_out": "Sair"
        }
    }
}
