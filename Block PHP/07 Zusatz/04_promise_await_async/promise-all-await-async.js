function downloadFile(fileName, delay, shouldFail = false) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if(shouldFail) {
                reject(new Error(`Fehler: Download von ${fileName} ist fehlgeschlagen`))
            } else {
                console.log(`Datei ${fileName} wurde erfolgreich downgeloadet`)
                resolve(fileName)
            }
        }, delay)
    })
}

async function downloadAllFiles() {
    console.log("Starte den Downloadprozess")

    const downloads = [
        downloadFile("data-1.txt", 1000),
        downloadFile("data-2.txt", 2000, true), // Fehler simulieren
        //downloadFile("data-2.txt", 5000),
        downloadFile("data-3.txt", 4000)
    ];

    try{
        const results = await Promise.all(downloads)
        console.log("alle Daten erfolgreich verarbeitet", results)
    } catch(error) {
        console.error("Ein Fehler ist aufgetreten", error.stack)
    }
}

downloadAllFiles()
    .then(()=>console.log("Download abgeschlossen"))
    .catch((error) => console.error("Fehler im Hauptprozess", error.message))