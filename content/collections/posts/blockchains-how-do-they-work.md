---
id: blockchains-how-do-they-work
blueprint: post
title: 'Blockchains: How do they work?'
publication_date: '2018-08-13 04:00:00'
modification_date: '2021-01-16 09:05:34'
---

[![Blockchains: How do they work?](/img/blog/Blockchains-1.jpg)](https://unsplash.com/photos/_QoAuZGAoPY 'Cityscape and interchange photo by Denys Nevozhai on Unsplash.com')

The word is out about blockchains and how awesome they are. Or how awful, depending who you ask. I have been spectating the discussion for years, but I recently decided to give it a real look.

In this article I will introduce the foundations on how does blockchain technology work.

## Sources

In order to cover a good amount of diversity, I chose three blockchains to look into: Bitcoin, Ethereum and Steem. I think those are representative enough to get started, but if you think I missed any game changer, let me know!

With so much controversy it is difficult to find impartial learning sources. I decided to start by reading the original whitepapers and search specific information based on that. They can be found on the following links:

- [Bitcoin: A Peer-to-Peer Electronic Cash System](https://bitcoin.org/bitcoin.pdf 'Bitcoin original whitepaper')
- [Ethereum: A Next-Generation Smart Contract and Decentralized Application Platform](https://ethereum.org/en/whitepaper/ 'Ethereum original whitepaper')
- [Steem: An Incetivized, Blockchain-based, Public Content Platform](https://steem.io/SteemWhitePaper.pdf 'Steem original whitepaper')

---

The key concept to understand is that blockchains are made to store information, that’s why sometimes you see them described as some kind of database. A blockchain is nothing more than a collection of records storing data. These records are called “blocks”. They have an intrinsic chronological order, because they store information about previous blocks. Together they are called "the blockchain".

The easiest way to understand the underlying nature of blockchains is to think of them as [Linked Lists](https://en.wikipedia.org/wiki/Linked_list).

Other than the basic architecture, there are some key properties which make blockchain technology unique: distribution, encryption and immutability.

## Distribution

This is probably the most important property of blockchains and what makes them extremely resilient.

It is possible to clone a blockchain, and such clone will be the same as the original. Computers running those clones are called “nodes”. And it doesn’t matter if the original blockchain is lost, as long as there is at least one active node, the system won’t be disrupted. All nodes together make the “blockchain network”.

Given that there isn't one true blockchain, you may be wondering how is the system protected from malicious nodes. This is solved using a [consensus algorithm](https://en.wikipedia.org/wiki/Consensus_%28computer_science%29), where a malicious node would need to control more than 50% of the network to manipulate records. It makes a blockchain more secure the bigger it grows.

## Encryption

Since anyone can join the network, it is necessary to validate information without trusting other nodes. And that is achieved with encryption. All the information in the blockchain is cryptographically tied together. In order to modify even one byte in a block, all subsequent blocks would need to be modified as well.

One interesting side-effect of this is how ownership works. In blockchain there aren’t any owners or “users”. Think about a traditional application, where a user is authenticated with a password. Because those applications are controlled by one entity, if the password is lost they can perform recovery operations and create a new password. But in blockchain the only thing that represents a “user” is the possession of the password, in this case a [private key](https://en.wikipedia.org/wiki/Public-key_cryptography). If the password is lost or stolen, it cannot be recovered.

That's why it isn't so much who owns anything, but what you can or cannot decrypt the data.

## Immutablity

As a consequence of distribution and encryption, blockchains are immutable. This doesn’t mean that the final application using the blockchain is immutable. Applications built on top of blockchains have a derived state, which can be inferred from traversing the entire chain. What this means is that anything from the derived state can be changed, but the history of modifications will always be recorded.

---

Having all this into account, it’s important to keep in mind something that isn’t immediately obvious. Operations performed on a blockchain can be really slow and resource-consuming.

The problem is not the operation itself. In order to trust an operation as valid, it should be spread through the network until it is considered secure. For example, in the Bitcoin blockchain it can take as long as [one hour](https://en.bitcoin.it/wiki/Confirmation) to have a confirmed transaction. And Ethereum nodes have to do a lot of [extra work](https://ethereum.stackexchange.com/questions/357/does-every-node-execute-the-contract-code-for-each-transaction) just to maintain security. Other blockchains have different timeframes and limitations, but this goes to show how unexpected consequences can arise from not knowing the specifics of a technology.

Blockchain is becoming a buzz word these days, and a lot of scams are disguising themselves with the cloak of this technology. Not to mention the amount of people who [have no idea](https://www.theguardian.com/technology/2017/nov/08/cryptocurrency-300m-dollars-stolen-bug-ether) about what they are doing. So be careful and get informed before getting involved in any blockchain endeavor.

_**Part II:** [Blockchains: Innovation or Sham?](https://noeldemartin.com/blog/blockchains-innovation-or-sham-)_
