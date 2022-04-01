const { promises: fs } = require("fs")
const path = require("path")

async function rmDir(src) {
    let entries = await fs.readdir(src, { withFileTypes: true });
    for (let entry of entries) {
        let srcPath = path.join(src, entry.name);

        entry.isDirectory() ?
            await rmDir(srcPath) :
            await fs.unlink(srcPath);
    }
}

async function copyDir(src, dest) {
    await fs.mkdir(dest, { recursive: true });
    let entries = await fs.readdir(src, { withFileTypes: true });

    for (let entry of entries) {
        let srcPath = path.join(src, entry.name);
        let destPath = path.join(dest, entry.name);

        entry.isDirectory() ?
            await copyDir(srcPath, destPath) :
            await fs.copyFile(srcPath, destPath);
    }
}

// Remove all Bootstrap SCSS files.
rmDir('./src/sass/theme/vendor/bootstrap');

// Copy all Bootstrap SCSS files.
copyDir('./node_modules/bootstrap/scss', './src/sass/theme/vendor/bootstrap');

// Copy all Font Awesome files.
copyDir('./node_modules/font-awesome/fonts', './fonts');
copyDir('./node_modules/font-awesome/css', './css');
