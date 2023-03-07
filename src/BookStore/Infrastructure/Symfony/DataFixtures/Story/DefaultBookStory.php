<?php

namespace App\BookStore\Infrastructure\Symfony\DataFixtures\Story;

use App\BookStore\Infrastructure\Symfony\DataFixtures\Factory\Model\BookFactory;
use Zenstruck\Foundry\Story;

final class DefaultBookStory extends Story
{
    public function build(): void
    {
        BookFactory::new()
            ->withName('Shinning')
            ->withDescription('"Overlook Hotel" redirects here. For the real location where King stayed, and the inspiration of the Overlook in the novel, see The Stanley Hotel.')
            ->withAuthor('Stephen King')
            ->withContent(<<<EOM
The Shining is a 1977 horror novel by American author Stephen King. It is King's third published novel and first hardback bestseller; its success firmly established King as a preeminent author in the horror genre. The setting and characters are influenced by King's personal experiences, including both his visit to The Stanley Hotel in 1974 and his struggle with alcoholism. The novel was adapted into a 1980 film of the same name. The book was followed by a sequel, Doctor Sleep, published in 2013, which was adapted into a film of the same name.

The Shining centers on the life of Jack Torrance, a struggling writer and recovering alcoholic who accepts a position as the off-season caretaker of the historic Overlook Hotel in the Colorado Rockies. His family accompanies him on this job, including his young son Danny Torrance, who possesses "the shining", an array of psychic abilities that allow Danny to see the hotel's horrific past. Soon, after a winter storm leaves them snowbound, the supernatural forces inhabiting the hotel influence Jack's sanity, leaving his wife and son in grave danger.
EOM
)
            ->create()
        ;

        BookFactory::new()
            ->withName('A Tale of Two Cities')
            ->withDescription('For other uses, see A Tale of Two Cities (disambiguation). "The Golden Thread" redirects here. For the 1965 Indian film, see Subarnarekha (film).')
            ->withAuthor('Charles Dickens')
            ->withContent(<<<EOM
A Tale of Two Cities is a historical novel published in 1859 by Charles Dickens, set in London and Paris before and during the French Revolution. The novel tells the story of the French Doctor Manette, his 18-year-long imprisonment in the Bastille in Paris, and his release to live in London with his daughter Lucie whom he had never met. The story is set against the conditions that led up to the French Revolution and the Reign of Terror. In the Introduction to the Encyclopedia of Adventure Fiction, critic Don D'Ammassa argues that it is an adventure novel because the protagonists are in constant danger of being imprisoned or killed.[2]

As Dickens's best-known work of historical fiction, A Tale of Two Cities is said to be one of the best-selling novels of all time.[3][4][5] In 2003, the novel was ranked 63rd on the BBC's The Big Read poll.[6] The novel has been adapted for film, television, radio, and the stage, and has continued to influence popular culture.
EOM
            )
            ->create()
        ;

        BookFactory::new()
            ->withName('Carrie')
            ->withDescription('Carrie is a horror novel by American author Stephen King.')
            ->withAuthor('Stephen King')
            ->withContent(<<<EOM
Carrie is a horror novel by American author Stephen King. It was his first published novel, released on April 5, 1974, with a first print-run of 30,000 copies. Set primarily in the then-future year of 1979, it revolves around the eponymous Carrie White, a friendless, bullied high-school girl from an abusive religious household who uses her newly discovered telekinetic powers to exact revenge on those who torment her. In the process, she causes one of the worst local disasters the town has ever had. King has commented that he finds the work to be "raw" and "with a surprising power to hurt and horrify". Much of the book uses newspaper clippings, magazine articles, letters, and excerpts from books to tell how Carrie destroyed the fictional town of Chamberlain, Maine while exacting revenge on her sadistic classmates and her own mother, Margaret. Carrie was one of the most frequently banned books in United States schools in the 1990s[1] because of its violence, cursing, underage sex and negative view of religion.[2]

Several adaptations of Carrie have been released, including a 1976 feature film, a 1988 Broadway musical as well as a 2012 off-Broadway revival, a 1999 feature film sequel, a 2002 television film, and a 2013 feature film, which serves as a remake of the 1976 film. The book is dedicated to King's wife Tabitha King.
EOM
            )
            ->create()
        ;

        BookFactory::new()
            ->withName('The Little Prince')
            ->withDescription('For other uses, see A Tale of Two Cities (disambiguation). "The Golden Thread" redirects here. For the 1965 Indian film, see Subarnarekha (film).')
            ->withAuthor('Antoine de Saint-Exupéry')
            ->withContent(<<<EOM
A Tale of Two Cities is a historical novel published in 1859 by Charles Dickens, set in London and Paris before and during the French Revolution. The novel tells the story of the French Doctor Manette, his 18-year-long imprisonment in the Bastille in Paris, and his release to live in London with his daughter Lucie whom he had never met. The story is set against the conditions that led up to the French Revolution and the Reign of Terror. In the Introduction to the Encyclopedia of Adventure Fiction, critic Don D'Ammassa argues that it is an adventure novel because the protagonists are in constant danger of being imprisoned or killed.[2]

As Dickens's best-known work of historical fiction, A Tale of Two Cities is said to be one of the best-selling novels of all time.[3][4][5] In 2003, the novel was ranked 63rd on the BBC's The Big Read poll.[6] The novel has been adapted for film, television, radio, and the stage, and has continued to influence popular culture.
EOM
            )
            ->create()
        ;

        BookFactory::createMany(100);
    }
}
