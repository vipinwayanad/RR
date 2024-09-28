// Fetch Notifications (can be integrated with AJAX to pull real notifications)
function fetchNotifications() {
    // Simulate notification fetching with dummy data
    const notifications = [
        "Product alert for Rice at LuLu Hypermarket",
        "Price drop alert for Sugar at Ashis Super Mercato"
    ];

    const notificationBar = document.getElementById('notificationBar');
    notificationBar.innerHTML = notifications.map(notification => `<p>${notification}</p>`).join('');
}

function markAllAsRead() {
    // Mark all notifications as read
    const notificationBar = document.getElementById('notificationBar');
    notificationBar.innerHTML = "<p>All notifications marked as read.</p>";
}

function deleteAllNotifications() {
    // Clear notifications
    const notificationBar = document.getElementById('notificationBar');
    notificationBar.innerHTML = "<p>No notifications available.</p>";
}

// Simulate browsing shop products
function browseShop(shopId) {
    alert("Browsing products for " + shopId);
}

// Initialize notifications on page load
document.addEventListener('DOMContentLoaded', fetchNotifications);
