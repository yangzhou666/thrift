namespace php Services.User
service user{
    	map<i32,string> getinfo(1:i32 uid)
}