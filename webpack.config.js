const path = require("path")

module.exports = {
    entry: "./app/Resources/js/main.js",
    output: {
        filename: "index.js",
        path: path.resolve(__dirname, "public/assets/js")
    },
    mode: "development",
    type: "module"
}
