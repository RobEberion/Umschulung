function doSomething(callback) {
    setTimeout(() => {
        console.log('doSomething ausführen')
        callback('Callback result 1')
    }, 1000)
}

function doSomethingElse(input, callback) {
    setTimeout(() => {
        console.log(`doSomethingElse ausführen mit ${input}`)
        callback('Callback result 2')
    }, 1000)
}

function doAnotherThing(input, callback) {
    setTimeout(() => {
        console.log(`doSomethingElse ausführen mit ${input}`)
        callback('Callback result 3')
    }, 1000)
}

function doFinalThing(input, callback) {
    setTimeout(() => {
        console.log(`doSomethingElse ausführen mit ${input}`)
        callback('Callback result 4')
    }, 1000)
}

doSomething(function (result1) {
    doSomethingElse(result1, function (result2) {
        doAnotherThing(result2, function (result3) {
            doFinalThing(result3, function (result4) {
                console.log("Fertig:", result4);
            });
        });
    });
});
