---
id: configuring-a-moodlenet-instance-1
blueprint: comment
title: 'Configuring a MoodleNet instance - 1'
task: 'entry::configuring-a-moodlenet-instance'
publication_date: '2020-06-14 11:07:55'
---

After some tinkering, I've managed to get my instance up and running. You can find it at [learn.noeldemartin.social](https://learn.noeldemartin.social/discover).

I have to say it's been quite easy to set up. Following [the instructions](https://gitlab.com/moodlenet/frontend#deploying-moodlenet) works for the most part. There is only one thing that didn't work for me, and that was running the backend in console mode. But I could work around it executing commands in a running container like this: `docker-compose exec backend ./bin/moodle_net rpc "MoodleNet.Access.create_register_email(\"myemail@domain.com\")"`. It's also not specified in the instructions, but I made sure to use the `stable` image for the backend container.

Other than this, there were a couple of things I had to do that are particular to my use-case.

Since I am configuring an instance-of-one, I don't really care about emails so I didn't bother configuring them. The only problem I had with that is activating my account after signing up. Looking at the source code I found a way to do it programatically calling `MoodleNet.ReleaseTasks.user_set_email_confirmed("username")`.

Something else I had to configure differently is the networking, given that I am serving multiple websites from the same server. I already faced this problem installing Mastodon, so I did the same and ended up using [nginx-agora](https://github.com/NoelDeMartin/nginx-agora).

Finally, I wanted to set up automatic backups. Again, I had already faced this [installing my Solid POD](https://noeldemartin.com/tasks/configuring-a-self-hosted-solid-pod-server). So I used [rireki](https://github.com/noeldemartin/rireki) to upload daily backups to DigitalOcean spaces.

At one point I had issues building the image in the server. I was getting out-of-memory errors because I didn't have enough RAM on the server, and I thought I'd have to resize my droplet. But looking for alternatives I found a way to [share docker images without a repository](https://stackoverflow.com/questions/23935141/how-to-copy-docker-images-from-one-host-to-another-without-using-a-repository). I have to say, Docker is awesome and it took me a while to get the hang of it. But now that I've been using it for years it's been a life saver countless times.

I also did some small modifications to the code, most of which [I've reported](https://gitlab.com/moodlenet/meta/-/issues?scope=all&utf8=%E2%9C%93&state=opened&author_username=NoelDeMartin) as issues to be discussed in the main repo. You can find my fork with these modifications [here](https://gitlab.com/NoelDeMartin/moodlenet-frontend/-/compare/master...live).

I'd say this task is done now, but I'll leave it open for a couple of days to see if something comes up using it in production.
