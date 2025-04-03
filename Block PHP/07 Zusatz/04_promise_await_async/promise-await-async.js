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

    try{
        const file1 = await downloadFile("data-1.txt", 1000)
        console.log(`${file1} wurde verarbeitet`)

        const file2 = await downloadFile("data-2.txt", 2000, true) // Fehler simulieren
        console.log(`${file2} wurde verarbeitet`)

        const file3 = await downloadFile("data-3.txt", 1000)
        console.log(`${file3} wurde verarbeitet`)

        console.log("alle Daten erfolgreich verarbeitet")
    } catch(error) {
        console.error("Ein Fehler ist aufgetreten", error.message)
    }
}

downloadAllFiles()
    .then(()=>console.log("Download abgeschlossen"))
    .catch((error) => console.error("Fehler im Hauptprozess", error.message))