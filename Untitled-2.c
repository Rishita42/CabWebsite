#include&lt;sys/socket.h&gt;
#include&lt;stdio.h&gt;
#include&lt;unistd.h&gt;
#include&lt;string.h&gt;
#include&lt;netinet/in.h&gt;
#include&lt;netdb.h&gt;
#include&lt;arpa/inet.h&gt;
#include&lt;sys/types.h&gt;
int main(int argc,char *argv[])
{
int sd;
char buff[1024];
struct sockaddr_incliaddr,servaddr;
socklen_tclilen;
clilen=sizeof(cliaddr);
/*UDP socket is created, an Internet socket address structure is filled with
wildcard address &amp; server’s well known port*/
sd=socket(AF_INET,SOCK_DGRAM,0);

if (sd&lt;0)
{
perror (&quot;Cannot open Socket&quot;);
exit(1);
}
bzero(&amp;servaddr,sizeof(servaddr));
/*Socket address structure*/
servaddr.sin_family=AF_INET;
servaddr.sin_addr.s_addr=htonl(INADDR_ANY);
servaddr.sin_port=htons(5669);
/*Bind function assigns a local protocol address to the socket*/
if(bind(sd,(struct sockaddr*)&amp;servaddr,sizeof(servaddr))&lt;0)
{
perror(&quot;error in binding the port&quot;);
exit(1);
}
printf(&quot;%s&quot;,&quot;Server is Running…\n&quot;);
while(1)
{
bzero(&amp;buff,sizeof(buff));
/*Read the message from the client*/
if(recvfrom(sd,buff,sizeof(buff),0,(struct sockaddr*)&amp;cliaddr,&amp;clilen)&lt;0)
{
perror(&quot;Cannot rec data&quot;);
exit(1);
}
printf(&quot;Message is received \n&quot;,buff);
/*Sendto function is used to echo the message from server to client side*/
if(sendto(sd,buff,sizeof(buff),0,(struct sockadddr*)&amp;cliaddr,clilen)&lt;0)
{
perror(&quot;Cannot send data to client&quot;);
exit(1);

}
printf(&quot;Send data to UDP Client: %s&quot;,buff);
}
cloSe(sd);
return 0;
}