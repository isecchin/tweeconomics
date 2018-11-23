$(document).ready(function() {
    if (performance) {
        var t0 = performance.now();
        Tweeconomics.init();
        var tf = performance.now();
        console.log("Tweeconomics initialized in " + (tf - t0) + " ms");
    } else {
        Tweeconomics.init();
    }
});

/**
 * Returns true if myVar is a string
 *
 * source: http://stackoverflow.com/questions/4059147/check-if-a-variable-is-a-string
 *
 * @param  {mixed}  myVar The variable we'd like to test
 * @return {Boolean}      True if variable is a string
 */
function isString(myVar) {
    return typeof myVar === 'string' || myVar instanceof String;
}

/**
 * Returns true if myVar is an array, i.e, a list.
 *
 * source: http://stackoverflow.com/questions/4775722/check-if-object-is-array
 *
 * @param  {mixed}  myVar The variable we'd like to test
 * @return {Boolean}      True if variable is an array
 */
function isArray(myVar) {
    return Object.prototype.toString.call(myVar) === '[object Array]';
}

/**
 * Returns true if myVar is a JavaScript object.
 *
 * @param  {mixed}  myVar The variable we'd like to test
 * @return {Boolean}      True if variable is an object
 */
function isObject(myVar) {
    return Object.prototype.toString.call(myVar) === '[object Object]';
}

/**
 * Searches the array for the given key,
 * returns the value if found or null if not.
 *
 * @param  {array}
 * @param  {mixed}
 * @return {mixed}
 */
function findInArray(array, key) {
    for (var i = 0; i < array.length; i++) {
        if (key == array[i].key)
            return array[i];
    }

    return null;
}
