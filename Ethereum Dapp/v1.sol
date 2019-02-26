pragma solidity ^0.4.18;


contract Certificate{

    address public issuer;
    address public owner;

    string public first_name;
    string public last_name;
    string public Qualifiaction;
    string public Institute;
    uint public timestamp;


    modifier onlyIssuer() {
        require(msg.sender == issuer);
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


    function close() external onlyIssuer  { 
        selfdestruct(issuer);
    }
}

contract CertificateNotary {
    address [] public registeredCertificates;       // list of previously created contracts in an array of addresses. 
    event ContractCreated(address contractAddress);
    address public Owner;

    modifier onlyOwner() {
        require(msg.sender == Owner);
        _;
    }
    function CertificateNotary () public{
        Owner=msg.sender;
    }

    function createMarriage( address _owner, string _first_name, string _last_name, string _Qualifiaction, string _Institute, uint _timestamp) public returns (bool) {

        address new_certificate = new Certificate(msg.sender, _owner,  _first_name, _last_name, _Qualifiaction, _Institute, _timestamp);
        ContractCreated(new_certificate);
        registeredCertificates.push(new_certificate);
    }

    function getDeployedCertificates() public view returns (address[]) {
        return registeredCertificates;
    }

    function close() external onlyOwner { 
        selfdestruct(Owner);  // `owner` is the owners address
    }
}

//  0x31b2c6b7c6a60ebac7f19d9195f62381f20e9062, "chinmay" , "Rai" , "Btech", "IITD",  1551070321