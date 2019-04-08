pragma solidity ^0.4.18;

contract Certificate{

    address public issuer;
    address public owner;

    string public first_name;
    string public last_name;
    string public Qualifiaction;
    string public Institute;
    uint public timestamp;
    bytes32 [] public keys;

    modifier onlyIssuer() {
        require(msg.sender == issuer);
        _;
    }

    modifier onlyOwner() {
        require(msg.sender == owner);
        _;
    }

    function Certificate(address _issuer, address _owner, string _first_name, string _last_name,string _Qualifiaction, string _Institute, uint _timestamp) public {
        issuer = _issuer;
        owner = _owner;
        first_name = _first_name;
        last_name = _last_name;
        Qualifiaction = _Qualifiaction;
        Institute = _Institute;
        timestamp = _timestamp;
    }

    function addKey(bytes32 _key) public onlyOwner {
        keys.push(_key);
    }

    function remKey(bytes32 _key) public onlyOwner returns (bool){
        if(keys.length<1){
            return false;
        }
        for (uint i=0; i<keys.length; i++) {
            if(_key==keys[i]){
                keys[i] = keys[keys.length-1];
                keys.length--;
            }       
        }
        return true;
    }

    function authKey(bytes32 _key) public view returns (bool){
        bool a = false;
        for (uint i=0; i<keys.length; i++) {
            if(_key==keys[i]){
                a=true;
            }       
        }
        return a;
    }

    function close() external onlyIssuer  { 
        selfdestruct(issuer);
    }
}


contract CertificateNotary {
    address [] public registeredCertificates;       // list of previously created contracts in an array of addresses. 
    event ContractCreated(address contractAddress);
    mapping (address => bytes32) public userPass; 
    address public Owner;
    bytes32 public pwd;

    modifier onlyOwner() {
        require(msg.sender == Owner);
        _;
    }
    
    function CertificateNotary() public{
        Owner=msg.sender;
    }

    function set_pwd(bytes32 _pwd) public onlyOwner returns (bool){
        pwd= _pwd;
    }

    function createCert( address _owner, bytes32 _pwd, string _first_name, string _last_name, string _Qualifiaction, string _Institute, uint _timestamp) public onlyOwner returns (bool) {

        address new_certificate = new Certificate(msg.sender, _owner,  _first_name, _last_name, _Qualifiaction, _Institute, _timestamp);
        ContractCreated(new_certificate);
        userPass[_owner] = _pwd;
        registeredCertificates.push(new_certificate);
    }

    function getDeployedCertificates() public view returns (address[]) {
        return registeredCertificates;
    }

    function revokeCertificate(address _add) public view returns (bool) {
        if(registeredCertificates.length<1){
            return false;
        }
        for (uint i=0; i<registeredCertificates.length; i++) {
            if(_add==registeredCertificates[i]){
                registeredCertificates[i] = registeredCertificates[registeredCertificates.length-1];
                registeredCertificates.length--;
            }       
        }
        return true;
    }

    function close() external onlyOwner { 
        selfdestruct(Owner);  // `owner` is the owners address
    }
}

//  0x31b2c6b7c6a60ebac7f19d9195f62381f20e9062, "chinmay" , "Rai" , "Btech", "IITD",  1551070321