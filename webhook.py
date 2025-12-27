import requests
import time

token = "token_bot"
webhook_url = "https://yourdomain.com/bot.php"
api_url = f"https://botapi.rubika.ir/v3/{token}/updateBotEndpoints"


endpoints = [
    "ReceiveUpdate",
    "ReceiveInlineMessage", 
    "ReceiveQuery",
    "GetSelectionItem",
    "SearchSelectionItems"
]

headers = {
    "Content-Type": "application/json"
}

print("setting up Rubika endpoints ...")

for endpoint in endpoints:
    data = {
        "url": webhook_url,
        "type": endpoint
    }
    
    try:
        response = requests.post(api_url, json=data, headers=headers, timeout=30).json()
        
        print(f"{endpoint}:")
        if response.get('status') == 'OK':
            print(f"   ✅ done - status: {response.get('data', {}).get('status', 'Unknown')}")
        else:
            print(f"   ❌ error - response: {response}")
            
    except Exception as e:
        print(f"{endpoint}:")
        print(f"   ❌ error Network: {e}")
    
    time.sleep(0.5)  

print("the end!")

