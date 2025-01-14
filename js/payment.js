// Midtrans Integration Code Placeholder

// CLIENT-SIDE
// Assuming you use a button for initiating the payment
const initiatePayment = () => {
    // Replace this with your server-side endpoint to get the Midtrans Snap token
    fetch('midtrans-php-master/Midtrans.php', {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
            snap.pay(data.token, {
                onSuccess: function(result) {
                    console.log('Payment successful:', result);
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                },
                onClose: function() {
                    console.log('Payment popup closed.');
                }
            });
        })
        .catch(error => console.error('Error fetching Snap token:', error));
};

// Attach this function to your payment button
const paymentButton = document.getElementById('payment-button');
if (paymentButton) {
    paymentButton.addEventListener('click', initiatePayment);
}


// SERVER-SIDE (e.g., Node.js / Express.js)
const express = require('express');
const midtransClient = require('midtrans-client');
const app = express();

// Replace with your Midtrans credentials
const coreApi = new midtransClient.CoreApi({
    isProduction: false, // Change to 'true' for production
    serverKey: 'Mid-server-2MKfLw0-NyHYw8OHwsQuBlvL',
    clientKey: 'Mid-client-HJcAh_slGXrp4xUd'
});

app.get('midtrans-php-master/Midtrans.php', async (req, res) => {
    try {
        const transactionDetails = {
            transaction_details: {
                order_id: `ORDER-${Math.floor(Math.random() * 100000)}`,
                gross_amount: 200000 // Replace with your dynamic amount
            }
        };
        const snapResponse = await coreApi.createTransaction(transactionDetails);
        res.json({ token: snapResponse.token });
    } catch (error) {
        console.error('Error creating Midtrans token:', error);
        res.status(500).send('Error creating token');
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
