

if($loginAs=='customer'){
        $stmt=$conn->prepare("SELECT customer_id,username,account_password FROM customers WHERE username = ? OR email = ? OR phone = ?");
        $stmt->bind_param('sss', $loginCredential, $loginCredential, $loginCredential);
        $stmt->execute();
        $stmt->bind_result($customer_id,$username,$account_password);
    }
    else if($loginAs == 'shop_owner'){
        $stmt=$conn->prepare("SELECT shop_owner_id,username,account_password FROM shop_owners WHERE username = ? OR email = ? OR phone = ?");
        $stmt->bind_param('sss', $loginCredential, $loginCredential, $loginCredential);
        $stmt->execute();
        $stmt->bind_result($shop_owner_id,$username,$account_password);
    }
    else if($loginAs == 'admin'){
        $stmt=$conn->prepare("SELECT admin_id,username,account_password FROM admins WHERE username = ? OR email = ? OR phone = ?");
        $stmt->bind_param('sss', $loginCredential, $loginCredential, $loginCredential);
        $stmt->execute();
        $stmt->bind_result($admin_id,$username,$account_password);
    }