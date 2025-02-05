const express = require('express');
const multer = require('multer');
const path = require('path');
const cors = require('cors');

const server = express();
server.use(cors());

// Multer configuration for image upload
const storage = multer.diskStorage({
    destination: 'uploads/', // Directory for uploaded files
    filename: (req, file, cb) => {
        // Save the file with the format date-originalFileName
        cb(null, `${file.originalname}`);
    },
});

const upload = multer({ storage });

// Middleware to serve the 'uploads' folder as static files
server.use('/uploads', express.static(path.join(__dirname, 'uploads')));

// Endpoint for uploading images
server.post('/upload', upload.single('file'), (req, res) => {
    console.log(req.body);
    const file = req.file;

    if (file) {
        res.json({
            message: 'File uploaded successfully',
            fileUrl: `/uploads/${file.filename}`,
        });
    } else {
        console.log(file);
        res.status(400).json({ message: 'File upload failed' });
    }
});

// Start the server
const PORT = 3001;
server.listen(PORT, () => {
    console.log(`IMG is running at http://localhost:${PORT}`);
});
