import * as http from '../../lib/http.mjs';

self.onmessage = function(event) {
    const url = event.data;
    
    http.get(url)
        .then(response => response.json())
        .then(data => {
            self.postMessage({ success: true, data: data });
        })
        .catch(error => {
            self.postMessage({ success: false, error: error.message });
        });
};